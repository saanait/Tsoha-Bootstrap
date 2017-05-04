<?php

class GenretController extends BaseController{
    public static function index(){
        // kaikki genret
        $genret = Sarja::all();
        View::make('genre/etusivu.html', array('genret' => $genret));
    }
    
    public static function show($id){
        self::check_logged_in();
        $genre = Genre::find($id);
        $sarjat = Genre::sarjat($id);
        
        View::make('genre/genre_show.html', array('genre' => $genre, 'sarjat' => $sarjat));
    }
    
    public static function genre_list(){
        $genret = Genre::all();
        View::make('genre/genre_list.html', array('genret' => $genret));
    }
    
    // lomakkeen esittäminen
    public static function edit($id){
        self::check_logged_in();
        $genre = Genre::find($id);
        View::make('genre/genre_edit.html', array('attributes' => $genre));
    }
    
    //lomakkeen käsittely
    public static function update($id){
        self::check_logged_in();
        $params = $_POST;
        
        
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi']
        );

        $genre = new Genre($attributes);
        $errors = $genre->errors();
        
        if(count($errors) > 0){
            View::make('genre/genre_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            // update-metodin kutsuminen
            $genre->update();
        }  
            
        Redirect::to('/genre/' . $genre->id, array('message' => 'Genren tiedot muokattu onnistuneesti!'));
        
    }

    public static function destroy($id){
        self::check_logged_in();
        $genre = new Genre(array('id'=> $id));
        
        $genre->destroy();
        
        // Käyttäjä siirretään listaussivulle ilmoituksen kera
        Redirect::to('/genre_list', array('message' => 'Genre poistettu onnistuneesti!'));
    }


    public static function create(){
        self::check_logged_in();
        View::make('genre/new_genre.html');
    }
    
    public static function store(){
        self::check_logged_in();
        // POST-pyynnön muuttujat sijaitsevat $_POST -nimisessä assosiaatiolistassa
        $params = $_POST;
        
        $attributes = array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus']
        );

        $genre = new Genre($attributes);
        $errors = $genre->errors();
        
        
        
        if(count($errors) == 0) {
            $genre->save();
                    
        Redirect::to('/genre/' .$genre->id, array('message' => 'Tiedot tallennettu onnistuneesti!'));
        } else {
            View::make('genre/new_genre.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
}

