<?php

class DashboardUtenteModifica extends Controller
{

    function index()
    {
        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:'. ROOT . 'DashboardLogin');
            exit;
        }

        $DB = Database::getDB();
        
        if (!isset( $_POST['email']) || $_POST['email'] == null) {
            header( 'Location: '. ROOT . 'NotFound404');
            exit;
        }

        if (isset($_POST['newUsername'])) {
            $query = 'Call ChangeUsername(:email, :newUsername)';
            $result = $DB->write($query, $_POST);

            if ($result) $result = "edited";
            else $result = "error";

            header( 'Location: '. ROOT . 'dashboardUtenti/'. $result);
            exit;
        }

        
        echo render_view("dashboard.utenteModifica", $_POST);
    }
}