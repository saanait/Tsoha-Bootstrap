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

$routes->get('/sarja/:id', function($id){
SarjaController::show($id);
});

$routes->get('/sarja', function(){
SarjaController::index();
});

