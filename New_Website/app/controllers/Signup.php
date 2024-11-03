<?php
Class Signup extends Controller
{

    function index() # i parametri passati da app.php vengono passati agli argomenti della funzione
    {
        $data = [];
        $output = [ 'error' => '' ];
        $user = self::loadModel("user");

        if ($user->check_signedin()){
            header('Location:'. ROOT . 'account');
            exit;
        }

        if (isset($_POST['email']) && isset($_POST['password']) && $user != false){
            $output = $user->signup($_POST);
        }

        if (is_array($output)){
            $data = array_merge($data, $output);
        }
        else{
            header('Location:'. ROOT . 'signin/registered');
            exit;
        }


        echo render_view("signup", $data);
    }


    
}