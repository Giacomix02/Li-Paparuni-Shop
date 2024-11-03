<?php

Class Checkout extends Controller
{

    function index() # i parametri passati da app.php vengono passati agli argomenti della funzione
    {   
        // echo count($_POST);
        // exit;
        if (isset($_POST['order-is-submitted']) ) {
            $result = $this->createOrder($_POST);
            if (is_string($result)) $data['error'] = $result;
            else {
                $isLoggedIn = isset( $_SESSION['idCart']);
                if ($isLoggedIn) {
                    $DB = Database::GetDB();
                    $cartId = $_SESSION['idCart'];
                    $query = 'Call ClearCart(:idCart)';
                    $DB->write($query, ["idCart" => $cartId]);
                }
                else {
                    $_SESSION['cartProducts'] = [];
                } 
                header( 'Location: '. ROOT . 'accountOrders');
                exit;
            }
        }
        $user = $this->loadModel("user");
        $isLoggedIn = $user->check_signedin();
        $data['isLoggedIn'] = $isLoggedIn;
        $data['cartProducts'] = getCart();
        if (!is_array($data['cartProducts'])) {
            echo render_view("empty-cart", $data);
            exit;
        }
        $data['shipping'] = 5;
        $data['taxes'] = 2;
        $data['email'] = isset($_SESSION['email']) ? $_SESSION['email'] : null;
        echo render_view("checkout", $data);
    }

    private function createOrder($POST) {
        $DB = Database::GetDB();

        // $heWantsDefaultShipping = isset($POST['checkbox-default-shipping']);
        // if ($heWantsDefaultShipping) {
        //     
        // }
        $thisWillBeDefaultAddress = isset($POST['checkbox-default-address']);
        $orderData = [
            'Nome' => 1,
            'Cognome' => 1,
            'mail' => 1,
            'Telefono' => 0,
            'Via' => 1,
            'NumeroCivico' => 0,
            'Citta' => 1,
            'Provincia' => 1,
            'CAP' => 1
        ];
        // xNome VARCHAR(255), Cognome VARCHAR(255), mail VARCHAR(255), Telefono VARCHAR(255), Via VARCHAR(255), NumeroCivico VARCHAR(20), Citta VARCHAR(255), Provincia VARCHAR(255), CAP VARCHAR(255), IdCarrello Int unsigned

        $payload = array();
        // print_r($POST);
        // exit;
        foreach ($orderData as $field => $requirement) {
            
            if ($POST[$field] != null) {
                $payload[$field] = $POST[$field];
            }
            else {
                if ($requirement) return "riempire i campi obbligatori";
                $payload[$field] = null;
            }
        }
        $payload['IdCarrello'] = $_SESSION['idCart'];

        $query = 'Call CreateOrder(:Nome, :Cognome, :mail, :Telefono, :Via, :NumeroCivico, :Citta, :Provincia, :CAP, :IdCarrello)';
        return $DB->write($query, $payload);

        // if ($thisWillBeDefaultAddress) {
        //     $query = 'Call UpdateUserAddress(:email, :firstName, :lastName, :phone, :streetAddress, :streetAddressNumber, :country, :city, :province, :postalCode)';
        //     $DB->write($query, ["email" => $email, "firstName" => $firstName, "lastName" => $lastName, "phone" => $phone, "streetAddress" => $streetAddress, "streetAddressNumber" => $streetAddressNumber, "country" => $country, "city" => $city, "province" => $province, "postalCode" => $postalCode]);
        // }

        # 

    }

}