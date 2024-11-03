<?php

class Account extends Controller
{

    function index()
    {
        $DB = Database::getDB();
        $user = $this->loadModel("user");

        if (!$user->check_signedin()) {
            header('Location: /public/signin');
            return;
        }

        $session = $_SESSION;
        $email = $session['email'];

        $queryOrderNum = 'Call CountOrder(:Email)';
        $orders=$DB->read($queryOrderNum,["Email"=>$email]);

        $queryWishlistNum = 'Call CountWishlist(:Email)';
        $wishlist=$DB->read($queryWishlistNum,["Email"=>$email]);

        $queryGetOrders = 'Call GetOrders(:Email)';
        $ordersList=$DB->read($queryGetOrders,["Email"=>$email]);

        $out['infos'] = $session;
        $out['orders'] = $orders[0];
        $out['wishlist'] = $wishlist[0];

        if(!is_array($ordersList)){
            $out['orderList'] = [];
        }else{
            $out['orderList'] = array_slice($ordersList, 0, 4);
        }
        echo render_view("account",["data"=>$out]);
    }

}