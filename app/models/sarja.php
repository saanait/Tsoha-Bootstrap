<?php

class Sarja extends BaseModel{
    
    //Attribuutit
    public $id, $genre_id, $nimi, $katsottu, $kuvaus, $jaksoja, $kausia, $julkaistu, $network;
    
    //Konstruktori
    public function __construct($attributes = null) {
        parent::__construct($attributes);
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
    
}