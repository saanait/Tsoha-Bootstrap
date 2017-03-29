<?php

class Katselukerta extends BaseModel{
    
    //Attribuutit
    public $id, $katselija_id, $sarja_id, $katsottuPvm;
    
    //Konstruktori
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        //Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Katselukerta');
        //Suoritetaan kysely
        $query->execute();
        //Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $katselukerrat = array();
        
        //Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row){
            // PHP:n syntaksi alkion lisäämiseksi taulukkoon
            $katselukerrat[] = new Katselukerta(array(
                'id' => $row['id'],
                'katselija_id' => $row['katselija_id'],
                'sarja_id' => $row['sarja_id'],
                'katsottuPvm' => $row['katsottuPvm']
            ));
        } 
        return $katselukerrat;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Katselukerta WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $katselukerta = new Katselukerta(array(
                'id' => $row['id'],
                'katselija_id' => $row['katselija_id'],
                'sarja_id' => $row['sarja_id'],
                'katsottuPvm' => $row['katsottuPvm']
            ));
            
            return $katselukerta;
        }
        return null;
    }
    
}