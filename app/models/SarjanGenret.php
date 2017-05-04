<?php

class SarjanGenret extends BaseModel{
    public $sarja_id, $genre_id;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array(
            'validate_genret'
        );
    }
    
    public static function find($sarja_id){
        $query = DB::connection()->prepare('SELECT * FROM Genre WHERE sarja_id = :id');
        $query->execute(array('sarja_id' => $sarja_id));
        $row = $query->fetch();
        if($row){
            $genret = new Genret(array(
                'sarja_id' => $row['sarja_id'],
                'nimi' => $row['nimi']
            ));
            
            return $genret;
        }
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO SarjanGenret(sarja_id, genre_id) VALUES(:sarja_id, :genre_id) RETURNING id');
         $query->execute(array(
         'sarja_id'=> $this->sarja_id,
         'genre_id'=> $this->genre_id    
        ));    
         
         $row = $query->fetch();
         $this->id = $row['id'];
    }
    
    public function update(){
        
        $query = DB::connection()->prepare('UPDATE SarjanGenret SET sarja_id = :sarja_id, genre_id = :genre_id WHERE id = :id');
        $query->execute(array(
            'id' => $this->id,  
            'sarja_id' => $this->sarja_id,
            'genre_id' => $this->genre_id
            ));
    }
    
    public function destroy(){
        // Lisätään RETURNING id tietokantakyselymme loppuun, saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('DELETE FROM SarjanGenret WHERE sarja_id = :id');
        $query->execute(array('id' => $this->id));
    }  
    
    public function validate_genret() {
        $errors = array();
        
        if(count($genret) == 0) {
           $errors[] = 'Valitse vähintään yksi genre.';
        }
        return $errors;
    }
}

