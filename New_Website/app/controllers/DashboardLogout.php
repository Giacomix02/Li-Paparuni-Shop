<?php
class DashboardLogout extends Controller {
    function index() {
        $admin = self::loadModel("admin");
        if ($admin->check_loggedin()) {
            $admin->logout();
        }

        header('Location:'. ROOT . 'DashboardLogin');
        exit();
    }
}

