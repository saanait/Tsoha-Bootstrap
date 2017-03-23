<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
$routes->get('/series_list', function() {
  HelloWorldController::series_list();
});

$routes->get('/series_show', function() {
  HelloWorldController::series_show();
});

$routes->get('/series_edit', function() {
  HelloWorldController::series_edit();
});

$routes->get('/login', function() {
  HelloWorldController::login();
});

$routes->get('/etusivu', function() {
  HelloWorldController::etusivu();
});