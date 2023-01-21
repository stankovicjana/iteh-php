<?php

class Usluga {
    
    public $id;   
    public $naziv;   
    public $radnik;   
    
    public function __construct($id=null, $naziv=null, $radnik=null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
        $this->radnik = $radnik;
    }
    public static function getAll(DbBroker $broker)
    {
        $query = "SELECT u.*, p.imePrezime as radnik_imePrezime, count(t.id) as broj_termina FROM usluga u INNER JOIN radnik p on (u.radnik_id=p.id) LEFT JOIN termin t on (u.id=t.usluga) GROUP BY u.id ORDER BY u.id;";
        return $broker->executeQuery($query);
    }
    public static function add(Usluga $usluga,DbBroker $broker)
    {
        $query = "INSERT INTO usluga(naziv, radnik_id) VALUES('$usluga->naziv','$usluga->radnik')";
        return $broker->executeQuery($query);
    }
    public function deleteById(DbBroker $broker)
    {
        $query = "DELETE FROM usluga WHERE id=$this->id";
        return $broker->executeQuery($query);
    }
    public function update(Usluga $usluga,DbBroker $broker)
    {
        $query = "UPDATE usluga set naziv = '$usluga->naziv', radnik_id = $usluga->radnik WHERE id=$this->id";
        return $broker->executeQuery($query);
    }
    public static function getById($id,DbBroker $broker){
        $query = "SELECT * FROM usluga WHERE id=$id";
        return $broker->executeQuery($query);

    }

}
?>