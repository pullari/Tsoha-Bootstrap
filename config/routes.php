<?php

  $routes->get('/', function() {
    HelloWorldController::groups();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function() {
  	HelloWorldController::login();
  });

  $routes->get('/groupsTest', function(){
  	HelloWorldController::groups();
  });

  $routes->get('/topicTest', function(){
    HelloWorldController::topic();
  });

  $routes->get('/edit', function(){
    HelloWorldController::gedit();
  });

  //HelloWorldControlleria käyttävät polut ovat kaikki suunnitelmia, alempana on polkuja varsinaisiin toteutuksiin

  $routes->get('/topic/:id', function($id){
    TopicController::show($id);
  });

  $routes->post('/topic/:id', function($id){
    TopicController::store($id);
  });

  $routes->get('/groups', function(){
    GroupController::all();
  });

  $routes->get('/groups/:id', function($id){
    GroupController::find($id);
  });

  $routes->post('/groups/:id', function($id){
    GroupController::store($id);
  });

  $routes->get('/groups/:id/edit', function($id){
    GroupController::edit($id);
  });

