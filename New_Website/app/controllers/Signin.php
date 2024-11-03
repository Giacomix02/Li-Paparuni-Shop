<?php


Class Signin extends Controller {

    function index($registered = false){ # i parametri passati da app.php vengono passati agli argomenti della funzion

        $data = [];
        
        if ($registered == 'registered') {
            $data['top_message'] = 'Sei stato correttamente registrato, inserire le credenziali per accedere';
        }
        $output = [ 'error' => '' ];
        $user = self::loadModel("user");

        if ($user->check_signedin()){
            header('Location:'. ROOT . 'account');
            exit;
        }
        if (isset($_POST['email']) && isset($_POST['password'])){
            
            
            if ($user != false) {
                $output = $user->signin($_POST);
            }
        }

        #debug
        #$data['debug'] = $registered;

        if (is_array($output)){
            $data = array_merge($data, $output);
        }
        else {
            if(isset($_SESSION['cartProducts'])) {
                $cartProducts = $_SESSION['cartProducts'];
                unset($_SESSION['cartProducts']);

                $idCart = $_SESSION['idCart'];

                $DB = Database::GetDB();
                $query = 'Call AddxToCart(:idCart, :idProduct, :quantity)';

                foreach($cartProducts as $id => $product) {
                    $DB->write($query, ["idCart" => $idCart, "idProduct" => $id, "quantity" => $product['quantita']]);
                }
                
            }
            if(isset($_POST['originUrl'])) {
                header('Location:'. $_POST['originUrl']);
                exit;
            }
            header('Location:'. ROOT . 'account');
            exit;
        }
        echo render_view("signin", $data);
    }
}
?>