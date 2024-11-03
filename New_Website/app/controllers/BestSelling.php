<?php

Class BestSelling extends Controller{

    function index($tipo) {
        $DB = Database::getDB();
        $get = 'Call ListaDi(:tipo)';
        $tipo = str_replace('_', ' ', $tipo);
        $products = $DB->read($get, ['tipo' => $tipo]);
        if ($products == null) {
            echo render_view('empty-search');
            return;
        }
        echo render_view('lista-prodotti-no-filter', ['products' => $products]);
    }
}
