<?php

# qui ci vanno tutte le costanti del sito, hanno scope globale

define("WEBSITE_NAME", "Li Paparuni Shop");

# definisoc il db
define("DB_TYPE", "mariadb");
define("DB_HOST", "localhost");
define("DB_NAME", "ecommerce");
define("DB_USER", "root");
define("DB_PASS", "");

#definisco il protocollo
define("PROTOCOL", "http");

$path = str_replace("\\", "/", PROTOCOL . "://" . $_SERVER['SERVER_NAME'] . __DIR__ . "/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);

define("ROOT", str_replace("app/core", "public", $path));
define("ASSETS", "../../public/assets");

$dir = str_replace("\\", "/", __DIR__);

define("APP", str_replace("app/core", "app/", $dir ));
define("CACHE", str_replace("app/core", "public/cache", $dir ));
define("IMAGE", ROOT . "assets/images/product/");

define("ASSETS_DASHBOARD", ROOT . "assets/dashboard/");

define("DEBUG", true);

define("LOCALIMAGE", $_SERVER['DOCUMENT_ROOT'] . "/public/assets/images/product/");
define("LOCALBANNER", $_SERVER['DOCUMENT_ROOT'] . "/public/assets/images/slider/");


if(DEBUG){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}else{
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}