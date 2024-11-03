<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/router.php';

Route::add('/', function() {
    require __DIR__ . '/views/home.php';
});

Route::add('/shop', function() {
    require __DIR__ . '/views/shop-side-version-2.php';
});

Route::add('/cart', function() {
    require __DIR__ . '/views/cart.php';
});

Route::add('/faq', function() {
    require __DIR__ . '/views/faq.php';
});

Route::add('/about', function() {
    require __DIR__ . '/views/about.php';
});


Route::submit();