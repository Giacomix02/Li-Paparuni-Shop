<?php

class Products extends Controller
{

    private $filter =[
        "category" => null,
        "search" => null,
        "casaEditrice" => null,
        "orderBy" => null
    ];

    function index()
    {
        $data = array();
        $DB = Database::getDB();

        $getCaseEditrici = 'Call GetAllCaseEditrici()';
        $caseEditrici = $DB->read($getCaseEditrici, []);

        $getListageneri = 'Call ListaGeneri()';
        $listageneri = $DB->read($getListageneri, []);

        $get = $_GET;

        $this->filter["category"] = $get["category"] ?? null;
        $this->filter["search"] = $get["search"] ?? null;
        $this->filter["casaEditrice"] = isset($get["casaEditrice"]) ? str_replace('_', ' ', $get["casaEditrice"]) : null;
        $this->filter["orderBy"] = $get["orderBy"] ?? null;


        if( !(is_null($this->filter["category"]) and is_null($this->filter["search"]) and is_null($this->filter["casaEditrice"]) and is_null($this->filter["orderBy"]))){

            if ( isset($this->filter["search"]) and is_null($this->filter["category"])  and is_null($this->filter["casaEditrice"]) and is_null($this->filter["orderBy"])) {
                $this->search($this->filter["search"],$caseEditrici, $listageneri, $DB);
                return;
            }
            if(isset($this->filter["category"]) and is_null($this->filter["search"]) and is_null($this->filter["casaEditrice"]) && is_null($this->filter["orderBy"])){
                $this->listaProdottiPerGenere($this->filter["category"],$caseEditrici,$listageneri,$DB);
                return;
            }else{
                $this->filterAll($DB, $caseEditrici, $listageneri);
                return;
            }
        }else{
            $getListaProdotti = 'Call ListaProdotti()';
            $products = $DB->read($getListaProdotti, []);
            if (!is_array($products)) {
                echo render_view("empty-search");
                return;
            }


            $data['products'] = $products;
            $data['count'] = count($products);
            $data['caseEditrici'] = $caseEditrici;
            $data['listaGeneri'] = $listageneri;
            $data['filter'] = $this->filter;

            echo render_view("lista-prodotti", $data);
        }

    }

    private function search($search,$caseEditrici,$listageneri, $DB)
    {

        $get = 'Call SearchItems(?)';
        $products = $DB->read($get, [$search]);
        if(!is_array($products) ){
            echo render_view("empty-search");
        }else{
            $data['products'] = $products;
            $data['count'] = count($products);
            $data['caseEditrici'] = $caseEditrici;
            $data['listaGeneri'] = $listageneri;
            $data['filter'] = $this->filter;


            echo render_view("lista-prodotti", $data);
        }

    }

    private function listaProdottiPerGenere($category,$caseEditrici,$listageneri,$DB){
        $get = 'Call ListaProdottiPerGenere(:Category)';
        $products = $DB->read($get, ["Category" => $category]);
        if (!is_array($products)) {
            echo render_view('empty-search');
            return;
        }
        $data['products'] = $products;
        $data['count'] = count($products);
        $data['caseEditrici'] = $caseEditrici;
        $data['filter'] = $this->filter;
        $data['listaGeneri'] = $listageneri;


        echo render_view("lista-prodotti", $data);
    }


    private function filterAll($DB, $caseEditrici, $listageneri){
        $get = 'Call FilterSearch(:search, :category, :casaEditrice, :orderBy)';

        // Create an associative array with the filter parameters
        $params = [
            ':search' => $this->filter["search"],
            ':category' => $this->filter["category"],
            ':casaEditrice' => $this->filter["casaEditrice"],
            ':orderBy' => $this->filter["orderBy"]
        ];

        // Pass the parameters as an array
        $products = $DB->read($get, $params);

        if(!is_array($products) ){
            echo render_view("empty-search");
        } else{
            $data['products'] = $products;
            $data['count'] = count($products);
            $data['filter'] = $this->filter;
            $data['caseEditrici'] = $caseEditrici;
            $data['listaGeneri'] = $listageneri;

            echo render_view("lista-prodotti", $data);
        }
    }




}