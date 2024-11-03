<?php

class AccountManageOrder extends Controller
{

    function index($idOrdine = null)
    {
        if($idOrdine == null){
            header('Location:'.ROOT. "notFound404");
        }

        $DB = Database::getDB();
        $user = $this->loadModel("user");

        if (!$user->check_signedin()) {
            header('Location: /public/signin');
            return;
        }
        $session = $_SESSION;

        $email = $session['email'];

        $query = 'Call CountOrder(:Email)';
        $orders=$DB->read($query,["Email"=>$email]);

        $query = 'Call CountWishlist(:Email)';
        $wishlist=$DB->read($query,["Email"=>$email]);

        $query = 'Call GetOrderDetails(:IdOrdine)';
        $orderDetails=$DB->read($query,["IdOrdine"=>$idOrdine]);

        $query = 'Call GetOrderProducts(:IdOrdine)';
        $products=$DB->read($query,["IdOrdine"=>$idOrdine]);


        $out['infos'] = $session;
        $out['orders'] = $orders[0];
        $out['wishlist'] = $wishlist[0];
        $out['orderDetails'] = $orderDetails[0];
        $out['products'] = $products;
        $out["IdOrdine"] = $idOrdine;


        echo render_view("dash-manage-order",["data"=>$out]);
    }
}
