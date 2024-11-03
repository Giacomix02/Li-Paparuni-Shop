<?php
class DashboardCasaEditriceAggiunta extends Controller
{

    function index()
    {   
        $data = [];
        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:'. ROOT . 'DashboardLogin');
            exit;
        }

        if(isset($_POST['nome']) && $_POST['nome'] != "" ) {
            $DB = Database::getDB();

            $nome = $_POST['nome'];
            $sede = isset($_POST['sede']) ? $_POST['sede'] : null;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;

            $query = "Call GetCasaEditrice(:nome)";
            $result = $DB->read($query, ['nome' => $nome]);
            if (is_array($result)) {
                $data['nomeGiaPresente'] = "Nome già esistente";
                
            }
            else {
                $data['nomeGiaPresente'] = "";

                $query = "Call AddCasaEditrice(:nome, :sede, :telefono)";
                $result = $DB->write($query, [
                    'nome' => $nome,
                    'sede' => $sede,
                    'telefono' => $telefono
                    ]  
                );

                if ($result) $result = "added";
                else $result = "error";
                header("Location: ". ROOT. "dashboardCaseEditrici/". $result);
                exit;
            }
            
        }
        
        echo render_view("dashboard.casaEditriceAggiunta", $data);
    }
}