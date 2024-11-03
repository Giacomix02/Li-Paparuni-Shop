<?php

Class Controller
{
    protected function view($view, $data = [])
    {
        if(file_exists("../app/views/". $view.".php"))
            {
                include "../app/views/". $view.".php";
            }
            else
            {
                render_view("NotFound404");
            }
    }
    protected function loadModel($model)
    {
        if (file_exists("../app/models/". $model.".php"))
            {
                include "../app/models/". $model.".php";
                $model = new $model();
                return $model;
            }
        return false;
    }
}