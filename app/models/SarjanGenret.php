<?php

class SarjanGenret extends BaseModel{
    public $sarja_id, $genret;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
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
    
}

