<?php

class Katselija extends BaseModel{
    
    //Attribuutit
    public $id, $username, $password;
    
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
                'username' => $row['username'],
                'password' => $row['password']
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
                'username' => $row['username'],
                'password' => $row['password']
            ));
            
            return $katselija;
        }
        return null;
    }
    
    public static function authenticate($username, $password){
        $query = DB::connection()->prepare('SELECT * FROM Katselija WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        if($row){
            $katselija = new Katselija(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
          // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
            return $katselija;
        }else{
            // Käyttäjää ei löytynyt, palautetaan null
            return null;
        }
          
    }
}    