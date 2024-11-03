<?php
class DashboardOrdini extends Controller
{

    function index($code = null)
    {


        $DB = Database::getDB();
        $data['alert'] = $code;


        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:'. ROOT . 'DashboardLogin');
            exit;
        }
        
        if(isset($_POST['email'])){
            $getOrdiniByMail = "Call GetOrders(:email)";
            $Ordini = $DB->read($getOrdiniByMail, [':email' => $_POST['email']]);

            if (empty($Ordini)) {
                $data['ordini'] = [];
            }else{

                $data['ordini'] = $Ordini;

                for($i = 0; $i < count($Ordini); $i++){
                    $data['ordini'][$i]['Email'] = $_POST['email'];
                }
            }


        }else{
            $getOrdini = "Call GetAllOrdini()";
            $Ordini = $DB->read($getOrdini, []);

            if (empty($Ordini)) {
                $data['ordini'] = [];
            }else {
                $data['ordini'] = $Ordini;
            }
        }


        
        echo render_view("dashboard.ordini", $data);
    }
}