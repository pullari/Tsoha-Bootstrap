<?php

  function check_logged_in(){
    BaseController::check_logged_in();
  }

  $routes->get('/', function() {
    HelloWorldController::groups();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/loginTest', function() {
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

  $routes->get('/topic/:id', 'check_logged_in', function($id){
    TopicController::show($id);
  });

  $routes->post('/topic/:id', 'check_logged_in', function($id){
    TopicController::store($id);
  });

  $routes->get('/groups', 'check_logged_in', function(){
    GroupController::all();
  });

  $routes->get('/groups/:id', 'check_logged_in', function($id){
    GroupController::find($id);
  });

  $routes->post('/groups/:id', 'check_logged_in', function($id){
    GroupController::store($id);
  });

  $routes->get('/groups/:id/edit', 'check_logged_in', function($id){
    GroupController::edit($id);
  });

  $routes->post('/remove/:id', 'check_logged_in', function($id){
    GroupController::removeTopic($id);
  });

  $routes->post('/removeMessage/:id', 'check_logged_in', function($id){
    TopicController::removeMessage($id);
  });

  $routes->post('/edit/:id', 'check_logged_in', function($id){
    TopicController::updateMessage($id);
  });

  $routes->get('/login', function(){
    AccountController::login();
  });

  $routes->post('/login', function(){
    AccountController::handleLogin();
  });

  $routes->get('/logout',function(){
    AccountController::logout();
  });