<?php

Class Database{
    
    private static Database $db;

    private function db_connect (){
        try{
            #$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME);
            $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
        }catch (PDOException $e){
            die("Connection failed: " . $e->getMessage());
        }
        return $db;
    }


    public function read($query, $data = []){
        $DB = $this->db_connect();
        $stmt = $DB->prepare($query);

        if(count($data) == 0){
            $check = $stmt->execute();

        }else{
            $check =  $stmt->execute($data);
        }
        if($check){
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (is_array($data) && count($data) > 0){
                return $data;
            }

        }
        return false;

    }

    public function write($query, $data = []){
        $DB = $this->db_connect();
        
        $stmt = $DB->prepare($query);

        if(count($data) == 0){
            $stm = $DB->query($query);
            $check = $stmt ? 1 : 0;

        }else{
            $check =  $stmt->execute($data);

        }
        if($check){
            return true;
        }else{
            return false;
        }
    }
    public static function getDB(): Database
    {
        //create a singleton
        if(!isset(self::$db)){
            self::$db = new Database();
        }
        return self::$db;

    }
}