<?php

Class User {
    function signin($POST){

        $output = array();
        $DB = Database::getDB();
        if( strlen($POST['email']) > 0 && strlen($POST['password']) > 0 ){
            #$arr['username'] = $POST['username'];
            $arr['email'] = $POST['email'];
            $arr['password'] = hash('sha512', $POST['password']);

            $query = "Call UserVerification(:email, :password)"; 
            
            
            $data = $DB->read($query,$arr);

            
            if(is_array($data)){
                // logged in
                unset($_SESSION['admin-token']);
                $_SESSION['email']= $data[0]['Email'];
                $_SESSION['username'] = isset($data[0]['NomeUtente']) ? $data[0]['NomeUtente'] : null;
                $_SESSION['token']= $data[0]['Token'];

                unset($arr['password']);
                $query = "Call IdCartFromEmail(:email)"; 
                $data = $DB->read($query,$arr);
                $_SESSION['idCart'] = $data[0]['IdCarrello'];
                
                $bytes = random_bytes(30);
                $token = bin2hex($bytes);

                $token_insert = 'Call modifyToken(:email, :token)';
                $insert_data = [
                    'email' => $_SESSION['email'],
                    'token' => $token
                ];
                $DB->write($token_insert, $insert_data);
                $_SESSION['token'] = $token;
                return true;
            }
            else {
                $output['error'] = "Email o password errata";
            }
        }
        else{
            $output['error'] = 'Inserire le credenziali per accedere';
        }
        return $output;
    }

    function signup($POST){
        $output = array();
        $DB = Database::getDB();
        if(strlen($POST['email']) > 0 && strlen($POST['password']) > 0 ){
            $arr['username'] = isset($POST['username']) ? $POST['username'] : null;
            $arr['email'] = $POST['email'];
            $arr['password'] = hash('sha512', $POST['password']);
            
            
            $query = "Call SignUpUser(:email, :password, :username)"; 
            
            
            $data = $DB->write($query,$arr);
            if ($data){
                return true;
            }
            else {
                $output['error'] = "Email già in uso";
            }
        }
        else{
            $output['error'] = 'Email e password sono campi obbligatori';
        }
        return $output;
    }

    function signout(){
        $DB = Database::getDB();
        if (isset($_SESSION['token'])){
            $arr['token'] = $_SESSION['token'];
            $query = "Call RemoveToken(:token)";
            $data = $DB->write($query,$arr);
        }
        
        unset($_SESSION['email']);
        unset($_SESSION['username']);
        unset($_SESSION['token']);
        unset($_SESSION['idCart']);
    }

    public function check_signedin(){
        $DB = Database::getDB();

        if(isset($_SESSION['token'])){
            $arr['token'] = $_SESSION['token'];
            $arr['email'] = $_SESSION['email'];

            $query = "Call CheckToken(:email, :token)"; 
            $data = $DB->read($query,$arr);

            if(is_array($data) && count($data)>0){
                // altready logged correctly
                // $_SESSION['email']= $data[0]['Email'];
                // $_SESSION['username'] = isset($data[0]['Username']) ? $data[0]['Username'] : null;
                // $_SESSION['token']= $data[0]['Token'];
                return true;
            }
        }
        return false;
    }
}
