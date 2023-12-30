<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Interfaces\Http\Router;
use Laminas\Diactoros\ServerRequestFactory;
use HttpSoft\Emitter\SapiEmitter;

// Create a PSR-7 compliant request
$request = ServerRequestFactory::fromGlobals();

// Create an instance of the Router with controllers namespace
$router = new Router('App\\Interfaces\\Http\\Controllers');

// Load routes from routes.php
require_once __DIR__ . '/routes.php';

// Handle the request using the Router
$response = $router->handle($request);

// Create an emitter to send the response
$emitter = new SapiEmitter();
$emitter->emit($response);
