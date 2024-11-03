<?php
class DashboardGeneri extends Controller
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
           
            $query = 'Call DeleteGenere(:IdGenere)';
            $result = $DB->write($query, ['IdGenere' => $_POST['IdGenere']]);
            
            if ($result) $result = "deleted";
            else $result = "error";
            
            header( 'Location: '. ROOT . 'dashboardgeneri/'. $result);
            exit;
        }
        $get = 'Call ListaGeneri()';
        $Generi = $DB->read($get, []);

        
        $data['generi'] = $Generi;
        echo render_view("dashboard.generi", $data);
    }
}