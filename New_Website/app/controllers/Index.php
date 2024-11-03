<?php


Class Index extends Controller
{

    function index() # i parametri passati da app.php vengono passati agli argomenti della funzione
    {
        
        $data = array();
        $DB = Database::getDB();

        $bannersQuery = 'Call ListaBanners()';
        $banners = $DB->read($bannersQuery, []);
        // print_r($banners);
        // exit;
        if (is_bool($banners)) $banners = [];


        $GetSection1 = 'Call FilterSearch(:search, :category, :casaEditrice, :orderBy)';
        $Section1 = $DB->read($GetSection1, [
            "search" => null,
            "category" => null,
            "casaEditrice" => null,
            "orderBy" => "DataPubblicazione"
        ]);

        

        $GetSection2 ='Call TopXProdotti(:topX)';
        $Section2 = $DB->read($GetSection2, [
            "topX" => 8
        ]);

        $GetSection3 ='Call TopXCaseEditrici(:topX)';
        $Section3 = $DB->read($GetSection3, [
            "topX" => 8
        ]);

        echo render_view("index", ["heroSlides"=>$banners, "Section1"=>$Section1, "Section2"=>$Section2, "Section3"=>$Section3]);
    }


    
}