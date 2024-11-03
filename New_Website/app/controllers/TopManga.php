<?php

Class TopManga extends Controller{

    function index() {
        $DB = Database::getDB();

        $get = 'Call TopXProdotti(:topX)';
        $products = $DB->read($get, [
            'topX' => 50
        ]);
        if ($products == null) {
            echo render_view('empty-search');
            return;
        }
        echo render_view('lista-prodotti-no-filter', ['products' => $products]);
    }
}
