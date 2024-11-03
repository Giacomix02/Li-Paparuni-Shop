<?php
class DashboardHome extends Controller
{

    function index()
    {

        $DB = Database::getDB();

       $admin = self::loadModel("admin");
       if (!$admin->check_loggedin()) {
           header('Location:'. ROOT . 'DashboardLogin');
           exit;
       }

        $countTotalOrders = 'Call CountTotalOrders()';
        $totalOrders = $DB->read($countTotalOrders, []);

        $getRecentOrdes = 'Call GetAllOrdini()';
        $recentOrders = $DB->read($getRecentOrdes, []);

        $getTotaleSoldi = 'Call TotalMoneySpent()';
        $soldiTotali = $DB->read($getTotaleSoldi, []);

        $listaUtenti = "Call ListaUtenti()";
        $utenti = $DB->read($listaUtenti, []);

        $numeroUtenti = count($utenti);


        if(!is_array($recentOrders)){
            $out['orderList'] = [];
        }else{
            $out['orderList'] = array_slice($recentOrders, 0, 4);
        }

       

        $data = [
            'totalOrders' => $totalOrders[0],
            'recentOrders' => $out['orderList'],
            'soldiTotali' => isset($soldiTotali[0]['totale']) ? $soldiTotali[0]['totale'] : 0,
            'numeroUtenti' => $numeroUtenti
        ];

        
        echo render_view("dashboard.index", $data);
    }
}