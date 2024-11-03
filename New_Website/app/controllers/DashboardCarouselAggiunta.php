<?php


class DashboardCarouselAggiunta extends Controller
{

    function index()
    {

        $DB = Database::getDB();

        $admin = self::loadModel("admin");
        if (!$admin->check_loggedin()) {
            header('Location:' . ROOT . 'DashboardLogin');
            exit;
        }

        $id = [1,2,3,4,5,6,7,8,9];

        $getNumeriBannerUtilizzati = "Call getNumeroBannerArray()";
        $numeriBannerUtilizzati = $DB->read($getNumeriBannerUtilizzati);


        foreach ($numeriBannerUtilizzati as $key => $value) {
            $numeriBannerUtilizzati[$key] = $value['NumeroBanner'];
        }



        $newId = array_diff($id, $numeriBannerUtilizzati);
        $newId = array_values($newId);


        if (count($newId)==0){
            $result = "bannerLimit";
            header("Location: " . ROOT . "dashboardCarousel/" . $result);
            exit;
        }


        if (isset($_POST['nomeBanner'])) {

            $DB = Database::getDB();


            saveBanner($_FILES['img'], $newId[0]);

            $query = "Call AddBanner(:nomeBanner, :riga1, :riga2, :bottone, :testoBottone, :link, :visibile, :idBanner)";
            $result = $DB->write($query, [
                "nomeBanner" => $_POST['nomeBanner'],
                "riga1" => $_POST['riga1'],
                "riga2" => $_POST['riga2'],
                "bottone" => $_POST['bottone'],
                "testoBottone" => $_POST['testoBottone'],
                "link" => $_POST['link'],
                "visibile" => $_POST['visibile'],
                "idBanner" => $newId[0]
            ]);


            if ($result) $result = "added";
            else $result = "error";

            header("Location: " . ROOT . "dashboardCarousel/" . $result);
            exit;
        }


        echo render_view("dashboard.carouselAggiunta");
    }
}