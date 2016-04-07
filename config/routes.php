<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function() {
  	HelloWorldController::login();
  });

  $routes->get('/groups', function(){
  	HelloWorldController::groups();
  });

  $routes->get('/topicTest', function(){
    HelloWorldController::topic();
  });

  $routes->get('/edit', function(){
    HelloWorldController::gedit();
  });

  $routes->get('/topic', function(){
    TopicController::index();
  });

  $routes->get('/topic/:id', function($id){
    TopicController::show($id);
  });

