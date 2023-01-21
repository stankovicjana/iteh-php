<?php

class Radnik{
    
    public $id;   
    public $imePrezime;   
    
    public function __construct($id=null, $imePrezime=null)
    {
        $this->id = $id;
        $this->imePrezime = $imePrezime;
       
    }

  
    public static function getAll(DbBroker $broker)
    {
        $query = "SELECT * FROM radnik";
        return $broker->executeQuery($query);
    }
    public static function getById($id,DbBroker $broker)
    {
        $query = "SELECT * FROM radnik WHERE id=$id";
        return $broker->executeQuery($query);
 
    }
}

?>