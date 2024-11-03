<?php
class DashboardCasaEditriceModifica extends Controller
{

    function index($nome = null)
    {
        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:'. ROOT . 'DashboardLogin');
            exit;
        }

        $DB = Database::getDB();
        
        if ($nome == null) {
            header( 'Location: '. ROOT . 'NotFound404');
            exit;
        }
        
        if (isset($_POST['nuovaSede']) || isset($_POST['nuovoTelefono'])) {
            if(strlen($_POST['nuovoTelefono'])> 10) $data['error'] = "Numero di telefono troppo lungo";
            else{
                $query = 'Call UpdateCasaEditrice(:nome,:nuovaSede, :nuovoTelefono)';
                $result = $DB->write($query, ['nome' => $nome, 'nuovaSede' => $_POST['nuovaSede'], 'nuovoTelefono' => $_POST['nuovoTelefono']]);

                if ($result) $result = "edited";
                else $result = "error";

                header( 'Location: '. ROOT . 'dashboardCaseEditrici/'. $result);
                exit;
            }
        }
        
        
        $query = 'Call GetCasaEditrice(:Nome)';
        $nome = unsanitizeSpaces($nome);
        $casaEditrice = $DB->read($query, ['Nome' => $nome])[0];

        $data['Nome'] = $casaEditrice['Nome'];
        $data['Sede'] = $casaEditrice['Sede'];
        $data['NumeroTelefono'] = $casaEditrice['NumeroTelefono'];

        echo render_view("dashboard.casaEditriceModifica", $data);
    }
}