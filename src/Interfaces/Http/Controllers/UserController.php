<?php

namespace App\Interfaces\Http\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;

class UserController
{
	public function index(ServerRequestInterface $request): ResponseInterface
	{
		$response = new Response();
		$response->getBody()->write('Hello from /users route! These are the pased params: ' . print_r($request->getQueryParams(), true));
		return $response; //->withStatus(500)->withHeader('Content-Type', 'text/plain');
	}
}
