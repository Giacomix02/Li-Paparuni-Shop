<?php
class DashboardGenereAggiunta extends Controller
{

    function index()
    {
        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:'. ROOT . 'DashboardLogin');
            exit;
        }

        if(isset($_POST['nuovoGenere'])) {
            $DB = Database::getDB();


            $path = saveImage($_FILES['img']);

            $query = "Call AddGenere(:nuovoGenere, :path)";
            $result = $DB->write($query, ['nuovoGenere' => $_POST['nuovoGenere'], 'path' => $path]);

            if ($result) $result = "added";
            else $result = "error";
            
            header("Location: ". ROOT. "dashboardGeneri/". $result);
            exit;
        }
        echo render_view("dashboard.genereAggiunta");
    }
}