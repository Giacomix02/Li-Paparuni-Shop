<?php
class DashboardProdottoModifica extends Controller
{

    function index($id = null)
    {
        
        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:'. ROOT . 'DashboardLogin');
            exit;
        }

        $DB = Database::getDB();
        


        


        $getProdottoById = 'Call GetProductById(:idProdotto)';
        $prodotto = $DB->read($getProdottoById, ['idProdotto' => $id])[0];
        
        if (isset($_POST['requested'])) {
            $path = saveImage($_FILES['img']);
            if (!is_string($path)) {
            $path = $prodotto['Immagine'];
            }
            $query = 'Call UpdateProdotto(
                :idProdotto,
                :nome,
                :descrizione,
                :quantita,
                :ISBN,
                :prezzoOriginale,
                :prezzoAttuale,
                :CasaEditrice,
                :TipoProdotto,
                :genere,
                :dataPubblicazione,
                :immagine
                
            )';
            $payload = array_merge($_POST, ['idProdotto' => $id , 'immagine' => $path]);

            //remove the requested key from the payload
            unset($payload['requested']);

            if(!isset( $payload['genere'])) $payload['genere'] = GetIdGenereByIdProdotto($id);
            if(!isset( $payload['CasaEditrice'])) $payload['CasaEditrice'] = $prodotto['CasaEditrice'];
            if(!isset( $payload['CasaEditrice'])) $payload['CasaEditrice'] = $prodotto['TipoProdotto'];

            //se non setto l'immagine metti quella precedentr
            if ($path == null) $payload['immagine'] = $prodotto['immagine'];




            $result = $DB->write($query, $payload);

            if ($result) $result = "edited";
            else $result = "error";

            header( 'Location: '. ROOT . 'dashboardProdotti/'. $result);
            exit;
        }
        
        
        $query = 'Call GetProductById(:idProdotto)';
        $prodotto = $DB->read($query, ['idProdotto' => $id])[0];
        

        echo render_view("dashboard.ProdottoModifica", $prodotto);
    }
}
