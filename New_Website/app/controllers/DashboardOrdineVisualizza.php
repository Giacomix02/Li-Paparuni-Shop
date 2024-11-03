<?php
class DashboardOrdineVisualizza extends Controller
{

    function index($id = null)
    {
        $DB = Database::getDB();

        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:'. ROOT . 'DashboardLogin');
            exit;
        }

        if ($id == null) {
            header('Location:'. ROOT . 'Notfound404');
            exit;
        }
        if (isset($_POST['statoOrdine'])) {



            $query = 'Call UpdateOrder(:IdOrdine, :NomeGenere)';
            $result = $DB->write($query, ['IdOrdine' => $id, 'NomeGenere' => $_POST['statoOrdine']]);

            if ($result) $result = "edited";
            else $result = "error";

            header( 'Location: '. ROOT . 'dashboardordini/'. $result);
            exit;
        }

        $getOrdine = "Call GetOrderDetails(:IdOrdine)";
        $Ordine = $DB->read($getOrdine, ['IdOrdine' => $id]);


        echo render_view("dashboard.ordineVisualizza", $Ordine[0]);
    }
}