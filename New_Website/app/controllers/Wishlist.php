<?php

Class Wishlist extends Controller
{

    function index($idDelete = -1) # i parametri passati da app.php vengono passati agli argomenti della funzione
    {
        $DB = Database::getDB();
        $user = $this->loadModel("user");


        if (!$user->check_signedin()) {
            header('Location: /public/signin');
            return;
        }

        if($idDelete=='deleteAll'){
            $get = 'Call ClearAllWishlist(:email)';
            $DB->write($get,["email" => $_SESSION["email"]]);
            $this->renderAll($DB);
            return;
        }else if($idDelete!=-1 && $idDelete!=null){

            $get = 'Call UserWishlistRemove(:email, :idProduct)';
            $out =  $DB->write($get, ['email' => $_SESSION['email'], 'idProduct' => $idDelete]);
            $this->renderAll($DB);
            return;
        }else{
            if(isset($_POST['originUrl'])){
                $originUrl = $_POST['originUrl'];
                $id = $_POST['IdProdotto'];
                if ($id == null) return;


                if ($user->check_signedin()) {
                    $email = $_SESSION['email'];
                    $query = 'Call UserWishlistAdd(:email, :idProduct)';
                    $DB->write($query, ["email" => $email, "idProduct" => $id]);
                }


                header('Location:'. $originUrl);

            }
            else{
                $this->renderAll($DB);
            }
        }
    }

    function renderAll($DB)
    {
        $get = 'Call UserWishlist(:Email)';
        $out =  $DB->read($get, ['Email' => $_SESSION['email']]);

        if(!$out){
            echo render_view("empty-wishlist", []);
        }else{
            echo render_view("wishlist",["preferiti"=>$out]);
        }


    }

}