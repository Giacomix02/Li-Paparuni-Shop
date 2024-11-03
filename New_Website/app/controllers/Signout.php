<?php
Class Signout extends Controller
{

    function index()
    {
        $user = $this->loadModel("user");
        $user->signout();
        header( 'Location: '. ROOT );
        exit();
    }
    
}