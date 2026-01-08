<?php
class DB_Connector {
    private static $connect = null;

    public function openConnexion(){
		
        if(!isset($connect)){
            
            try{
                $connect = new PDO('mysql:host=localhost;dbname=scierie;charset=utf8', 'scierie', 'dVR&6jsY3391DYBaUysK', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_LOCAL_INFILE => true));
                
            } catch (PDOException $ex) {
                die('connexion echouée : '.$ex->getMessage());
            }
        }
        
	
        return $connect;
    }   

    public function closeConnexion(){
        
        if(isset($connect)){
            $connect = null;
        }        
    }
}
