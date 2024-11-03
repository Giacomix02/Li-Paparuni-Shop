<?php
    function getCart(){
        $cartProductsFull = array();
        
        $DB = Database::getDB();
        
        #debug
        // unset($_SESSION['cartProductsId']);
        // unset($_SESSION['idCart']);
        // $_SESSION['idCart'] = 1;


        if (isset($_SESSION['idCart'])) {
            $idCart = $_SESSION['idCart'];
            $cartProductsFull = $DB->read("Call GetCart(?)",[$idCart]); #array di carrello-prodotto
            if (is_bool($cartProductsFull)) return [];
            
        }
        elseif(isset($_SESSION['cartProducts'])) { 
            $cartProducts = $_SESSION['cartProducts']; # array di array di id di prodotto e quantità
            
            foreach ($cartProducts as $cartProduct) {
                $cartProductFull = $DB->read("Call GetProductById(?)",[$cartProduct['id']]);
                $cartProductFull = array_merge($cartProductFull[0], ['quantita' => $cartProduct['quantita']]);
                $cartProductsFull[] = $cartProductFull; # modo di appendere elementi in un array
            }
        }

        
        return $cartProductsFull;
    }

    function getGreeting(){
        if(!isset($_SESSION['token'])) return;
        if (strlen($_SESSION['username']) > 0) {
            return'hai effettuato il login come: '.$_SESSION['username'];
        }
        elseif (isset($_SESSION['email'])) {
            return 'hai effettuato il login come: '.$_SESSION['email'];
        }
        else {
            return "Benvenuto ospite";
        }
    }

function getGreetingCheDeveFareDaBenvenutoAllAdminNellaDashboardQuandoAccedeNellaSezioneDedicataCheVisualizzaLaEmailOppureLoUsernameNellaNavbarInAltoADestraConUnDropdownPerFareLaUscitaDallaSessioneERimandareAlLoginDaCuiSiPotraDiNuovoAccedereComeAdminERipetereLaStessaOperazioneAlloInfinito(){
    if(!isset($_SESSION['token'])) return;
    if (strlen($_SESSION['username']) > 0) {
        return $_SESSION['username'];
    }
    elseif (isset($_SESSION['email'])) {
        return $_SESSION['email'];
    }
    else {
        return "Benvenuto ospite";
    }
}

    function sanitizeSpaces($string) {
        # return string with spaces replaced with _
        return str_replace(' ', '_', $string);
    }
    function unsanitizeSpaces($string) {
        # return string with _ replaced with spaces
        return str_replace('_', ' ', $string);
    }

    function getCaseEditrici(){
        $DB = Database::getDB();
        $get = 'Call GetAllCaseEditrici()';
        $caseEditrici = $DB->read($get, []);
        return $caseEditrici;
    }

    function getGeneri(){
        $DB = Database::getDB();
        $get = 'Call ListaGeneri()';
        $generi = $DB->read($get, []);
        return $generi;
    }
    
    function getGenereById($id){
        $DB = Database::getDB();
        $get = 'Call GetGenereById(:IdGenere)';
        $genere = $DB->read($get, ['IdGenere' => $id]);
        return $genere[0];
    }

    function GetIdGenereByIdProdotto($id){
        $DB = Database::getDB();
        $get = 'Call GetIdGenereByIdProdotto(:IdProdotto)';
        $genere = $DB->read($get, ['IdProdotto' => $id]);
        if (is_bool($genere)) return 'non trovato';
        return $genere[0]['IdGenere'];
    }
    
    function saveImage($file) {
        if($file['name'] == null) return false;
        $filename= ($file['name']);
        $filetempname=$file['tmp_name'];
        $fname = sanitizeSpaces(md5($_SERVER['REMOTE_ADDR'].rand()).$filename);
        $filepath1 = LOCALIMAGE.$fname;
        move_uploaded_file($filetempname,$filepath1);
        return basename($filepath1);
    }

    function saveBanner($file, $id) {
        if($file['name'] == null) return false;
        $filename= ($file['name']);


        $filetempname=$file['tmp_name'];

        $fname = "slide-".$id."."."jpg";
        $filepath1 = LOCALBANNER.$fname;

        $files = glob(LOCALBANNER . "slide-" . $id . ".*");
        foreach ($files as $file) {
            if(is_file($file)) {
                unlink($file);
            }
        }


        move_uploaded_file($filetempname,$filepath1);
        return basename($filepath1);
    }


?>