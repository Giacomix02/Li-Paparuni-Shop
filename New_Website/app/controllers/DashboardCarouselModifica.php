<?php

class DashboardCarouselModifica extends Controller
{

    function index($id = null)
    {


       $admin = self::loadModel("admin");
       if (!$admin->check_loggedin()) {
           header('Location:'. ROOT . 'DashboardLogin');
           exit;
       }



       if ($id == null || !is_numeric($id)) {
        header( 'Location: '. ROOT . 'NotFound404');
        exit;
        }

        $DB = Database::getDB();

        $query = 'Call GetBannerById(:IdBanner)';
        $banner = $DB->read($query, ['IdBanner' => $id])[0];

        if (isset($_POST['requested'])) {
            if (isset($_FILES['img'])){
                $path = saveBanner($_FILES['img'], $banner['NumeroBanner']); # TODO: mettere numero banner
            }
            $query = 'Call UpdateBanner(
            :IdBanner, 
            :NomeBanner,
            :Riga_1, 
            :Riga_2, 
            :Bottone, 
            :Testo_Bottone, 
            :Link, 
            :Visibile)';

            $result = $DB->write($query, [
                'IdBanner' => $id, 
                'NomeBanner' => $_POST['NomeBanner'],
                'Riga_1' => $_POST['Riga_1'], 
                'Riga_2' => $_POST['Riga_2'], 
                'Bottone' => $_POST['Bottone'], 
                'Testo_Bottone' => $_POST['Testo_Bottone'], 
                'Link' => $_POST['Link'], 
                'Visibile' => $_POST['Visibile']]);

            if ($result) $result = "edited";
            else $result = "error";



            header( 'Location: '. ROOT . 'dashboardCarousel/'. $result);
            exit;
        }

        $query = 'Call GetBannerById(:IdBanner)';
        

        echo render_view("dashboard.carouselModifica", $banner);
    }
}
