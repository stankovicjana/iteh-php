<?php

class Termin {
    
    public $id;   
    public $usluga;   
    public $klijent;   
    public $datum;   
    public $lokacija;
    
    public function __construct($id=null, $usluga=null, $klijent=null, $datum=null,  $lokacija=null)
    {
        $this->id = $id;
        $this->usluga = $usluga;
        $this->klijent = $klijent;
        $this->lokacija = $lokacija;
        $this->datum = $datum;
    }

    public static function getAll(DbBroker $broker){
        $query = "SELECT t.*, u.naziv as usluga_naziv FROM termin t INNER JOIN usluga u on (t.usluga=u.id)";
        return $broker->executeQuery($query);
    }

    public static function getAll2(mySqli $conn){
        $query = "select * from termin";
        return $conn->query($query);
    }

    public static function getById($id,DbBroker $broker){
        $query = "SELECT * FROM termin WHERE id=$id";
        return $broker->executeQuery($query);
    }

    public static function getAllByUsluga($id,DbBroker $broker){
        $query = "SELECT * FROM termin WHERE usluga=$id";
        return $broker->executeQuery($query);
    }

    public function deleteById(DbBroker $broker)
    {
        $query = "DELETE FROM termin WHERE id=$this->id";
        return $broker->executeQuery($query);
    }


    public static function add(Termin $termin, DbBroker $broker)
    {
        $query = "INSERT INTO termin(usluga, klijent, datum, lokacija) VALUES('$termin->usluga','$termin->klijent','$termin->datum','$termin->lokacija')";
        return $broker->executeQuery($query);
    }
    public function update(Termin $termin, DbBroker $broker)
    {
        $query = "UPDATE termin set usluga = $termin->usluga,klijent = '$termin->klijent',datum = '$termin->datum',lokacija = $termin->lokacija WHERE id=$this->id";
        return $broker->executeQuery($query);
    }
}
?>