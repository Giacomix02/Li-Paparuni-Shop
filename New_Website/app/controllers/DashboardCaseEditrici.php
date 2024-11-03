<?php

class DashboardCaseEditrici extends Controller
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
            $query = 'Call DeleteCasaEditrice(:Nome)';

            $result = $DB->write($query, ['Nome' => $_POST['CasaEditrice']]);
            
            if ($result) $result = "deleted";
            else $result = "error";
            
            header( 'Location: '. ROOT . 'dashboardCaseEditrici/'. $result);
            exit;
            
        }
       
        $get = 'Call ListaCaseEditrici()';
        $CaseEditrici = $DB->read($get, []);

        
        $data['CaseEditrici'] = $CaseEditrici;
        echo render_view("dashboard.caseEditrici", $data);
    }
}