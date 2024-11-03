<?php

class AccountEditProfile extends Controller
{

    function index()
    {
        $DB = Database::getDB();
        $post = $_POST;
        $session = $_SESSION;
        $email = $session['email'];
        $user = $this->loadModel("user");

        if (!$user->check_signedin()) {
            header('Location: /public/signin');
            return;
        }


        if(sizeof($post)){
            if(isset($post["edit_password"])){
                $old_password = hash("sha512",$post["old_password"]);
                $new_password = hash("sha512",$post["new_password"]);

                $changePassword= 'Call ChangePassword(:Email,:Old_Password,:New_Password)';
                $verifyPassword= 'Call CheckPassword(:Email,:Old_Password)';

                $verify=$DB->read($verifyPassword,["Email"=>$email, "Old_Password"=>$old_password]);


                if ($verify[0]["Risultato"]==0){
                    $infoPass['passInfo'] = "Password errata";
                    $this->render($DB,$infoPass);
                    return;
                }else{
                    $DB->read($changePassword,["Email"=>$email, "Old_Password"=>$old_password, "New_Password"=>$new_password]);
                    $infoPass['passInfo'] = "Password cambiata con successo";
                    $this->render($DB,$infoPass);
                    return;
                }

            }else if(isset($post["edit_username"])){
                $username = $post["new_username"];
                $changeUsername= 'Call ChangeUsername(:Email,:Username)';
                $DB->read($changeUsername,["Email"=>$email, "Username"=>$username]);
                $infoUser['userInfo'] = "Username cambiato con successo";
                $_SESSION['username'] = $username;
                $this->render($DB,null,$infoUser);
                return;
            }

        }

        $this->render($DB);
    }


    function render($DB,$infoPass=null, $infoUser=null)
    {
        $session = $_SESSION;
        $email = $session['email'];
        error_reporting(E_ERROR | E_PARSE);
        $query = 'Call CountOrder(:Email)';
        $orders=$DB->read($query,["Email"=>$email]);

        $query = 'Call CountWishlist(:Email)';
        $wishlist=$DB->read($query,["Email"=>$email]);


        $out['passInfo'] = $infoPass['passInfo'];
        $out['userInfo'] = $infoUser['userInfo'];
        $out['infos'] = $session;
        $out['orders'] = $orders[0];
        $out['wishlist'] = $wishlist[0];


        echo render_view("dash-edit-profile",["data"=>$out]);
    }

}