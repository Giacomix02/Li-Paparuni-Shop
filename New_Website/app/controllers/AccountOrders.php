<?php

class AccountOrders extends Controller
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

        $query = 'Call CountOrder(:Email)';
        $orders=$DB->read($query,["Email"=>$email]);

        $query = 'Call CountWishlist(:Email)';
        $wishlist=$DB->read($query,["Email"=>$email]);

        $queryGetOrders = 'Call GetOrders(:Email)';
        $ordersList=$DB->read($queryGetOrders,["Email"=>$email]);


        $out['infos'] = $session;
        $out['orders'] = $orders[0];
        $out['wishlist'] = $wishlist[0];

        if (is_array($ordersList)) {
            $out['orderList'] = $ordersList;
        }else{
            $out['orderList'] = [];
        }

        echo render_view("dash-my-order",["data"=>$out]);
    }

}