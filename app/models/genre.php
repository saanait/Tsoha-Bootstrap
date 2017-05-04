<?php

class Genre extends BaseModel{
    
    //Attribuutit
    public $id, $nimi, $kuvaus;
    
    //Konstruktori
    public function __construct($attributes = null) {
        parent::__construct($attributes);
         $this->validators = array(
            'validate_nimi'
        );     
    }
    
    public static function genret($sarja_id){
        $query = DB::connection()->prepare('SELECT genre_id, nimi FROM SarjanGenret INNER JOIN Genre g ON (g.id = genre_id) WHERE sarja_id = :id');
        $query->execute(array('id' => $sarja_id));
        $rows = $query->fetchAll();
//        Kint::dump($rows);
        if($rows){
            $genret = array();
            foreach ($rows as $row){
//                Kint::dump($row);
                $genret[] = new Genre(array(
                    'id' => $row['genre_id'],
                    'nimi' => $row['nimi']
                ));
            }
//            Kint::dump($genret);
            return $genret;
        }
        return null;
    }
    
    public static function all(){
        //Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Genre ORDER BY nimi ASC');
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
    
    public function save(){
        // Lisätään RETURNING id tietokantakyselymme loppuun, saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Genre (nimi, kuvaus) VALUES (:nimi, :kuvaus) RETURNING id');
        // Olion attribuuttiin pääsee synktaksilla $this->attribuutin_nimi
        $query->execute(array(
            'nimi' => $this->nimi,
            'kuvaus' => $this->kuvaus
        ));
        //  Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Genre SET nimi = :nimi, kuvaus = :kuvaus WHERE id = :id');
        $query->execute(array('id' => $this->id,  'nimi' => $this->nimi, 'kuvaus' => $this->kuvaus));
        
    }
    
    public function destroy(){
        // Lisätään RETURNING id tietokantakyselymme loppuun, saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('DELETE FROM Genre WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }    
    
    public static function sarjat($genre_id){
        $query = DB::connection()->prepare('SELECT sarja_id, nimi FROM SarjanGenret INNER JOIN Sarja s ON (s.id = sarja_id) WHERE genre_id = :id');
        $query->execute(array('id' => $genre_id));
        $rows = $query->fetchAll();
        if($rows){
            $sarjat = array();
            foreach ($rows as $row){
                $sarjat[] = new Genre(array(
                    'id' => $row['sarja_id'],
                    'nimi' => $row['nimi']
                ));
            }
            return $sarjat;
        }
        return null;
    }
    
    public function validate_nimi() {
        $errors = array();
        if($this->nimi == ' ' || $this->nimi == null) {
            $errors[] = 'Nimi puuttuu.';
        }
        if(strlen($this->nimi) < 3){
            $errors[] = 'Nimen pituus tulee olla vähintään kolme merkkiä.';
        }
        
        return $errors;
    }
    
}