<?php
class DashboardLogin extends Controller
{

    function index()
    {   
        $data = [];
        $output = [];

        $admin = self::loadModel("admin");

        if ( $admin->check_loggedin()) {
            header('Location:'. ROOT . 'dashboardhome');
            exit;
        }
        if (isset($_POST['email']) && isset($_POST['password'])){
            if ($admin != false) {
                $output = $admin->login($_POST);
            }
            if (is_array($output)){
                $data = array_merge($data, $output); # passato error ($output["error"])
            }
            else {
                if(isset($_POST['originUrl'])) {
                    header('Location:'. $_POST['originUrl']);
                    exit;
                }
                header('Location:'. ROOT . 'dashboardhome');
                exit;
            }
        }

        
        # passare error, e altro che serve
        echo render_view("dashboard.login", $data);
    }
}