<?php

class SarjaController extends BaseController{
    public static function index(){
        // kaikki sarjat
        $sarjat = Sarja::all();
        View::make('sarja/etusivu.html', array('sarjat' => $sarjat));
    }
}

