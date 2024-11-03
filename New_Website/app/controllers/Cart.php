<?php
Class Cart extends Controller
{

    function index() # i parametri passati da app.php vengono passati agli argomenti della funzione
    {
        if (isset($_POST['action'])) $this->actions($_POST['action'], $_POST['id']);
        $data = array();
        $cartProducts = getCart();
        if ( count($cartProducts) == 0) echo render_view("empty-cart", $data);
        else {
            $data['cartProducts'] = $cartProducts;
            $data['shipping'] = 5;
            $data['taxes'] = 2;
            echo render_view("cart", $data);
        }
    }

    private function actions($param1, $id) {
        switch ($param1) {
            case "clear":
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
                break;
            case "update":
                if (!isset($_POST['productIds'])) echo "Errore interno, è stata modificata la richiesta";
                $productIds = unserialize($_POST['productIds']);

                $isLoggedIn = isset( $_SESSION['idCart']);
                
                if ($isLoggedIn) $DB = Database::GetDB();

                foreach($productIds as $id) {
                    $quantity = $_POST['quantity-in-cart-'.$id];
                   
                    if ($isLoggedIn) {
                        $cartId = $_SESSION['idCart'];
                        $query = 'Call ModifyQuantityCart(:idCart, :idProduct, :quantity)';
                        $DB->write($query, ["idCart" => $cartId, "idProduct" => $id, "quantity" => $quantity]);
                    }
                    else {
                        #print_r($_SESSION['cartProducts']);
                        if (isset($_SESSION['cartProducts'][$id])) $_SESSION['cartProducts'][$id]['quantita'] = $quantity;
                    }
                }

                break;
            case "remove":
                $originUrl = $_POST['originUrl'];
                if ($id == null || !isset($_POST['originUrl'])) echo "Errore interno, è stata modificata la richiesta";
                $user = $this->loadModel("user");

                $DB = Database::GetDB();
                

                if (isset( $_SESSION['idCart'])) {
                    $cartId = $_SESSION['idCart'];
                    $query = 'Call RemoveFromCart(:idCart, :idProduct)';
                    $DB->write($query, ["idCart" => $cartId, "idProduct" => $id]);
                }
                else {
                    $cartProducts = $_SESSION['cartProducts'];
                    unset($cartProducts[$id]);
                    $_SESSION['cartProducts'] = $cartProducts;
                }
                header('Location:'. $originUrl);
                exit;
                break;
            case 'add':
                $originUrl = $_POST['originUrl'];
                if ($id == null || !isset($_POST['originUrl'])) return;
                $DB = Database::GetDB();
                $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

                if (isset( $_SESSION['idCart'])) {

                    $cartId = $_SESSION['idCart'];
                    $query = 'Call AddxToCart(:idCart, :idProduct, :quantity)';
                    $DB->write($query, ["idCart" => $cartId, "idProduct" => $id, "quantity" => $quantity]);
                }
                else {
                    $cartProducts = isset($_SESSION['cartProducts']) ? $_SESSION['cartProducts'] : [];

                    if (isset($cartProducts[$id])) {
                        $cartProducts[$id]['quantita'] += $quantity;
                    }
                    else {
                        $cartProducts[$id] = ['id' => $id, 'quantita' => $quantity];
                    }
                    $_SESSION['cartProducts'] = $cartProducts;
                }
                header('Location:'. $originUrl);
                exit;
                break;
        }
        header('Location:'. ROOT . 'cart');
        exit;
    }

}