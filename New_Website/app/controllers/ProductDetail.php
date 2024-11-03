<?php


class ProductDetail extends Controller
{

    function index($param = null)
    {
        $data = array();
        $DB = Database::getDB();


        if ($param == null || !is_numeric($param)) {
            header('Location:'. ROOT . 'NotFound404');
        }else{
            $get = 'Call GetProductById(:id)';
            $product = $DB->read($get,["id"=>$param]);

            $consigliati = "Call SimilarProducts(:id)";
            $consigliati = $DB->read($consigliati,["id"=>$param]);
            if (is_bool($consigliati)) $consigliati = [];

            $data['consigliati'] = $consigliati;
            $data['product'] = $product[0];

            if(count($product) == 0){
                header('Location:'. ROOT . 'NotFound404');
            }else{
                echo render_view('product-detail',$data);
            }
        }
    }

}



// pagina prodotti
// clicco su un prodotto
// visualizzare i dettagli

//pag prod -> id prodotto -> pag dettagli prodotto
// href="/product-detail/{!!IdProdotto!!}"