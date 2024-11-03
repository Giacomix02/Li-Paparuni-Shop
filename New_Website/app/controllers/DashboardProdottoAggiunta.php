<?php
class DashboardProdottoAggiunta extends Controller
{

    function index()
    {
        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:'. ROOT . 'DashboardLogin');
            exit;
        }

        
        if (isset($_POST['requested'])) {
            $DB = Database::getDB();
            $path = saveImage($_FILES['img']);
            if (!is_string($path)) {
            $path = '';
            }
            $query = 'Call AddProdotto(
                :nome,
                :descrizione,
                :quantita,
                :ISBN,
                :prezzoOriginale,
                :prezzoAttuale,
                :CasaEditrice,
                :TipoProdotto,
                :genere,
                :dataPubblicazione,
                :immagine
                
            )';
            $payload = array_merge($_POST, ['immagine' => $path]);

            unset($payload['requested']);
            
            if(!isset( $payload['genere'])) $payload['genere'] = GetIdGenereByIdProdotto($id);
            $result = $DB->write($query, $payload);

            if ($result) $result = "edited";
            else $result = "error";

            header( 'Location: '. ROOT . 'dashboardProdotti/'. $result);
            exit;
        }



        echo render_view("dashboard.prodottoAggiunta");
    }
}