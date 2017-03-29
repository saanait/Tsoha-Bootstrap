<?php

class Katselija extends BaseModel{
    
    //Attribuutit
    public $id, $genre_id, $salasana;
    
    //Konstruktori
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        //Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Katselija');
        //Suoritetaan kysely
        $query->execute();
        //Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $katselijat = array();
        
        //Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row){
            // PHP:n syntaksi alkion lisäämiseksi taulukkoon
            $katselija[] = new Katselija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'genre_id' => $row['salasana']
            ));
        } 
        return $katselijat;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Katselija WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $katselija = new Katselija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'katsottu' => $row['salasana']
            ));
            
            return $katselija;
        }
        return null;
    }
    
}