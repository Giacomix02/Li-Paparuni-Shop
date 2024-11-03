<?php

class DashboardCarousel extends Controller
{

    function index($code = null)
    {

        $DB = Database::getDB();

       $admin = self::loadModel("admin");
       if (!$admin->check_loggedin()) {
           header('Location:'. ROOT . 'DashboardLogin');
           exit;
       }

       $data['alert'] = $code;

       if(isset($_POST['delete'])) {
        $query = 'Call DeleteBanner(:IdBanner)';

        $result = $DB->write($query, ['IdBanner' => $_POST['IdBanner']]);
        
        if ($result) $result = "deleted";
        else $result = "error";
        
        header( 'Location: '. ROOT . 'dashboardCarousel/'. $result);
        exit;
        }

       
       

       $get = 'Call ListaBanners()';
       $banners = $DB->read($get, []);

       $banners = is_bool($banners) ? [] : $banners;
       
       $data['banners'] = $banners;


        echo render_view("dashboard.carousel", $data);
    }
}