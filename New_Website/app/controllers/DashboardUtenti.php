<?php

class DashboardUtenti extends Controller
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


        $get = 'Call ListaUtenti()';
        $utenti = $DB->read($get, []);

        $data['utenti'] = $utenti;
        echo render_view("dashboard.utenti", $data);
    }
}