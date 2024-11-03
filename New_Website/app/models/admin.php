<?php

Class Admin {
    function login($POST){

        $output = array();
        $DB = Database::getDB();
        if( strlen($POST['email']) > 0 && strlen($POST['password']) > 0 ){
            #$arr['username'] = $POST['username'];
            $arr['email'] = $POST['email'];
            $arr['password'] = hash('sha512', $POST['password']);

            $query = "Call AdminVerification(:email, :password)"; 
            
            
            $data = $DB->read($query,$arr);

            
            if(is_array($data)){
                // logged in
                
                $_SESSION['email']= $data[0]['Email'];
                $_SESSION['username'] = isset($data[0]['NomeUtente']) ? $data[0]['NomeUtente'] : null;

                
                $bytes = random_bytes(30);
                $token = bin2hex($bytes);

                $token_insert = 'Call modifyToken(:email, :token)';
                $insert_data = [
                    'email' => $_SESSION['email'],
                    'token' => $token
                ];
                $DB->write($token_insert, $insert_data);
                $_SESSION['admin-token'] = $token;
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


    function logout(){
        $DB = Database::getDB();
        if (isset($_SESSION['token'])){
            $arr['token'] = $_SESSION['token'];
            $query = "Call RemoveToken(:token)";
            $data = $DB->write($query,$arr);
        }
        
        unset($_SESSION['email']);
        unset($_SESSION['username']);
        unset($_SESSION['admin-token']);
    }

    public function check_loggedin(){
        $DB = Database::getDB();

        if(isset($_SESSION['admin-token'])){
            $arr['token'] = $_SESSION['admin-token'];
            $arr['email'] = $_SESSION['email'];

            $query = "Call CheckToken(:email, :token)"; 
            $data = $DB->read($query,$arr);

            if(is_array($data) && count($data)>0){
                return true;
            }
        }
        return false;
    }
}
