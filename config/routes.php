<?php

$routes->get('/', function() {
  HelloWorldController::index();
});

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

$routes->get('/login', function() {
  HelloWorldController::login();
});

$routes->get('/etusivu', function() {
  HelloWorldController::etusivu();
});

$routes->get('/sarja', function(){
SarjaController::index();
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

// Sarjan esittelysivu
$routes->get('/sarja/:id', function($id){
SarjaController::show($id);
});



