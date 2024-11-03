<?php
Class Category extends Controller{

    function index($category=null) {
        $DB = Database::getDB();
        $get = 'Call ListaGeneri()';
        $products = $DB->read($get, []);

        echo render_view('lista-categorie', ['listacategorie' => $products]);
    }
}