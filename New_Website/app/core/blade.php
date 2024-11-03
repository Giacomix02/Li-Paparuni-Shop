<?php


use eftec\bladeone\BladeOne;


$views = APP . 'views';
$cache = CACHE;


$blade = new BladeOne(
    $views,
    $cache,
    BladeOne::MODE_DEBUG
);


function render_view(string $view, array $data = []): string
{

    global $blade;


    try{
        return $blade->run($view, $data);
    }catch (Exception $e){
        return ($e->getMessage());
    }

}
