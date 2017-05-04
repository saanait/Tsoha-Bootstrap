<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/hiekkalaatikko', function() {
  HelloWorldController::sandbox();
});
  
$routes->get('/sarja_list', function() {
  SarjaController::sarja_list();
});

$routes->get('/sarja_show', function() {
  HelloWorldController::sarja_show();
});

$routes->get('/sarja_edit', function() {
  HelloWorldController::sarja_edit();
});

// Kirjautumislomakkeen näyttö
$routes->get('/login', function() {
  UserController::login();
});

// Kirjautumisen käsittely
$routes->post('/login', function(){
    UserController::handle_login();
});

$routes->get('/etusivu', function() {
  HelloWorldController::etusivu();
});

// Sarjan lisääminen tietokantaan
$routes->post('/sarja', function(){
    SarjaController::store();
});

// Sarjan lisäyslomakkeen näyttäminen
$routes->get('/sarja/new', 'check_logged_in', function(){
    SarjaController::create();
});

// Sarjan muokkaussivu
$routes->get('/sarja/:id/edit', 'check_logged_in', function($id){
SarjaController::edit($id);
});

// Sarjan tietojen muokkaus
$routes->post('/sarja/:id/edit', 'check_logged_in', function($id){
SarjaController::update($id);
});

// Sarjan poisto
$routes->post('/sarja/:id/destroy', 'check_logged_in', function($id){
SarjaController::destroy($id);
});

// Sarjan esittelysivu
$routes->get('/sarja/:id', function($id){
SarjaController::show($id);
});


$routes->get('/sarja', function(){
SarjaController::index();
});

$routes->get('/', function() {
  HelloWorldController::index();
});

// uloskirjautumisen käsittely
$routes->post('/logout', function(){
  UserController::logout();
});

// genret

$routes->get('/genre_list', function() {
  GenretController::genre_list();
});

// Genren lisääminen tietokantaan
$routes->post('/genre', function(){
    GenretController::store();
});

// Genren lisäyslomakkeen näyttäminen
$routes->get('/genre/new_genre', 'check_logged_in', function(){
    GenretController::create();
});

// Genren muokkaussivu
$routes->get('/genre/:id/edit', 'check_logged_in', function($id){
    GenretController::edit($id);
});

// genren tietojen muokkaus
$routes->post('/genre/:id/edit', 'check_logged_in', function($id){
    GenretController::update($id);
});

// genren poisto
$routes->post('/genre/:id/destroy', 'check_logged_in', function($id){
    GenretController::destroy($id);
});

// genren esittelysivu
$routes->get('/genre/:id', function($id){
    GenretController::show($id);
});
