<?php



$routes->get('/hiekkalaatikko', function() {
  HelloWorldController::sandbox();
});
  
$routes->get('/sarja_list', function() {
  HelloWorldController::sarja_list();
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
$routes->get('/sarja/new', function(){
    SarjaController::create();
});

// Sarjan muokkaussivu
$routes->get('/sarja/:id/edit', function($id){
SarjaController::edit($id);
});

// Sarjan tietojen muokkaus
$routes->post('/sarja/:id/edit', function($id){
SarjaController::update($id);
});

// Sarjan poisto
$routes->post('/sarja/:id/destroy', function($id){
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

