<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
$routes->get('/game', function() {
  HelloWorldController::series_list();
});
$routes->get('/game/1', function() {
  HelloWorldController::series__show();
});

$routes->get('/game/1', function() {
  HelloWorldController::series__edit();
});

$routes->get('/login', function() {
  HelloWorldController::login();
});