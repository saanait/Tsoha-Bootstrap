<?php

class Sarja extends BaseModel{
    
    //Attribuutit
    public $id, $genre_id, $nimi, $katsottu, $kuvaus, $jaksoja, $kausia, $julkaistu, $network;
    
    //Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_julkaistu', 'validate_network', 'validate_kuvaus', 'validate_jaksoja', 'validate_kausia');
    }
    
    public static function all(){
        //Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Sarja');
        //Suoritetaan kysely
        $query->execute();
        //Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $sarjat = array();
        
        //Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row){
            // PHP:n syntaksi alkion lisäämiseksi taulukkoon
            $sarjat[] = new Sarja(array(
                'id' => $row['id'],
                'genre_id' => $row['genre_id'],
                'nimi' => $row['nimi'],
                'katsottu' => $row['katsottu'],
                'kuvaus' => $row['kuvaus'],
                'jaksoja' => $row['jaksoja'],
                'kausia' => $row['kausia'],
                'julkaistu' => $row['julkaistu'],
                'network' => $row['network']
            ));
        } 
        return $sarjat;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Sarja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $sarja = new Sarja(array(
                'id' => $row['id'],
                'genre_id' => $row['genre_id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus'],
                'jaksoja' => $row['jaksoja'],
                'kausia' => $row['kausia'],
                'julkaistu' => $row['julkaistu'],
                'network' => $row['network']
            ));
            
            return $sarja;
        }
        return null;
    }
    
    public function save(){
        // Lisätään RETURNING id tietokantakyselymme loppuun, saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Sarja (nimi, network, julkaistu, kausia, jaksoja, kuvaus) VALUES (:nimi, :network, :julkaistu, :kausia, :jaksoja, :kuvaus) RETURNING id');
        // Olion attribuuttiin pääsee synktaksilla $this->attribuutin_nimi
        $query->execute(array('nimi' => $this->nimi, 'network' => $this->network, 'julkaistu' => $this->julkaistu, 'kausia' => $this->kausia, 'jaksoja' => $this->jaksoja, 'kuvaus' => $this->kuvaus));
        //  Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
//        Kint::trace();
//        Kint::dump($row);
                

    }
    
    public function update(){
        
        $query = DB::connection()->prepare('UPDATE Sarja SET nimi = :nimi, network = :network, julkaistu = :julkaistu, kausia = :kausia, jaksoja = :jaksoja, kuvaus = :kuvaus WHERE id = :id');
        $query->execute(array('id' => $this->id,  'nimi' => $this->nimi, 'network' => $this->network, 'julkaistu' => $this->julkaistu, 'kausia' => $this->kausia, 'jaksoja' => $this->jaksoja, 'kuvaus' => $this->kuvaus));
        
    }
    
    public function destroy(){
        // Lisätään RETURNING id tietokantakyselymme loppuun, saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('DELETE FROM Sarja WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }    
    
    public function validate_nimi() {
        $errors = array();
        if($this->nimi == ' ' || $this->nimi == null) {
            $errors[] = 'Nimi puuttuu.';
        }
        if(strlen($this->nimi) < 2){
            $errors[] = 'Nimen pituus tulee olla vähintään kaksi merkkiä.';
        }
        
        return $errors;
    }
    
    public function validate_julkaistu() {
        $errors = array();
        if($this->julkaistu == ' ' || $this->julkaistu == null) {
            $errors[] = 'Julkaisuaika puuttuu.';
        }
        if(strlen($this->julkaistu) < 8){
            $errors[] = 'Julkaisuajan pitää olla vähintään 10 merkkiä pitkä.';
        }
//        if(is_numeric($this->julkaistu)== FALSE) {
//            $errors[] = 'Julkaisuaika virheellinen!';
//        }
        
        return $errors;
    }    
    public function validate_network() {
        $errors = array();
        if($this->network == ' ' || $this->network == null) {
            $errors[] = 'Network puuttuu.';
        }
        if(strlen($this->network) < 2){
            $errors[] = 'Network-kentän pituus tulee olla vähintään kaksi merkkiä.';
        }
        
        return $errors;
    }
    
    public function validate_kuvaus() {
        $errors = array();
        if($this->kuvaus == ' ' || $this->kuvaus == null) {
            $errors[] = 'Kuvaus puuttuu';
        }
        if(strlen($this->kuvaus) < 10){
            $errors[] = 'Kuvauksen pituus tulee olla vähintään kymmenen merkkiä.';
        }
        if(strlen($this->kuvaus) > 400){
            $errors[] = 'Kuvauksen maksimipituus 400 merkkiä!';
        }
        
        
        return $errors;
    }

    public function validate_jaksoja() {
        $errors = array();
        if($this->jaksoja == ' ' || $this->jaksoja == null) {
            $errors[] = 'Jaksojen lukumäärä puuttuu.';
        }

        if(is_numeric($this->jaksoja)== FALSE) {
            $errors[] = 'Jaksojen lukumäärä ei ole numero.';
        }
        
        return $errors;
    }

    public function validate_kausia() {
        $errors = array();
        if($this->kausia == ' ' || $this->kausia == null) {
            $errors[] = 'Kausien lukumäärä puuttuu';
        }
        if(is_numeric($this->kausia)== FALSE) {
            $errors[] = 'Kausien lukumäärä ei ole numero.';
        }
        
        return $errors;
    }    
}