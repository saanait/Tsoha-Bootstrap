<?php

class Genre extends BaseModel{
    
    //Attribuutit
    public $id, $nimi, $kuvaus;
    
    //Konstruktori
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        //Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Genre');
        //Suoritetaan kysely
        $query->execute();
        //Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $genret = array();
        
        //Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row){
            // PHP:n syntaksi alkion lisäämiseksi taulukkoon
            $genret[] = new Genre(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
            ));
        } 
        return $genret;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Genre WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $genre = new Genre(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'katsottu' => $row['kuvaus']
            ));
            
            return $genre;
        }
        return null;
    }
    
}