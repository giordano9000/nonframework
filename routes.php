<?php

// Use $router variable from index.php
/** @var Router $router */

$router->get('/', 'HomeController@index');
$router->get('/users', 'UserController@index');
$router->post('/users', 'UserController@create');
