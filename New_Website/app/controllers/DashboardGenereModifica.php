<?php
class DashboardGenereModifica extends Controller
{

    function index($idGenere = null)
    {
        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:'. ROOT . 'DashboardLogin');
            exit;
        }

        $DB = Database::getDB();

       

        if ($idGenere == null) {
            header( 'Location: '. ROOT . 'NotFound404');
            exit;
        }

        $genereById = 'Call GetGenereById(:IdGenere)';
        $genere = $DB->read($genereById, ['IdGenere' => $idGenere]);

        if (isset($_POST['nuovoGenere'])) {
            $path = saveImage($_FILES['img']);

            if (!is_string($path)) {
                $path = $genere['ImmagineGenere'];
            }
            
            $query = 'Call UpdateGenere(:NomeGenere, :ImmagineGenere, :IdGenere)';
            $result = $DB->write($query, ['NomeGenere' => $_POST['nuovoGenere'],'ImmagineGenere' => $path, 'IdGenere' => $idGenere]);

            if ($result) $result = "edited";
            else $result = "error";

            header( 'Location: '. ROOT . 'dashboardgeneri/'. $result);
            exit;
        }

        

        $data = ['IdGenere' => $idGenere];
        $data['genere'] = $genere[0];

        echo render_view("dashboard.genereModifica", $data);
    }
}