<?php

namespace App\Interfaces\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response;

class RequestHandler implements RequestHandlerInterface
{

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		// Your logic here to handle the request and generate a response
		$responseData = [
			'message' => 'Hello from RequestHandler!',
			'request_body' => $request->getBody()->getContents(),
		];

		$response = new Response();
		$response->getBody()->write(json_encode($responseData));
		$response = $response->withHeader('Content-Type', 'application/json');

		return $response;
	}

}
