<?php
class DashboardProdotti extends Controller
{

    function index($code = null)
    {
        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:'. ROOT . 'DashboardLogin');
            exit;
        }
        
        $data['alert'] = $code;

        $DB = Database::getDB();

        if(isset($_POST['delete'])) {
            $query = 'Call DeleteProdotto(:idProdotto)';

            $result = $DB->write($query, ['idProdotto' => $_POST['idProdotto']]);
            
            if ($result) $result = "deleted";
            else $result = "error";
            
            header( 'Location: '. ROOT . 'dashboardProdotti/'. $result);
            exit;
        }

        $get = 'Call ListaProdotti()';
        $Prodotti = $DB->read($get, []);

        $Prodotti = is_bool($Prodotti) ? [] : $Prodotti;
        
        $data['Prodotti'] = $Prodotti;

        echo render_view("dashboard.prodotti", $data);
    }
}