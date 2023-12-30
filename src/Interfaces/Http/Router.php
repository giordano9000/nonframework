<?php

namespace App\Interfaces\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Router implements RequestHandlerInterface
{
	private array $routes = [];
	private string $controllerNamespace;

	public function __construct(string $controllerNamespace)
	{
		$this->controllerNamespace = $controllerNamespace;
	}

	private function addRoute(string $method, string $path, string $controllerMethod): void
	{
		$this->routes[$method][$path] = $controllerMethod;
	}

	public function get(string $path, string $controllerMethod): void
	{
		$this->addRoute('GET', $path, $controllerMethod);
	}

	public function post(string $path, string $controllerMethod): void
	{
		$this->addRoute('POST', $path, $controllerMethod);
	}

	public function patch(string $path, string $controllerMethod): void
	{
		$this->addRoute('PATCH', $path, $controllerMethod);
	}

	public function put(string $path, string $controllerMethod): void
	{
		$this->addRoute('PUT', $path, $controllerMethod);
	}

	public function delete(string $path, string $controllerMethod): void
	{
		$this->addRoute('DELETE', $path, $controllerMethod);
	}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$method = $request->getMethod();
		$path = $request->getUri()->getPath();

		if (isset($this->routes[$method][$path])) {
			[$controllerClass, $handlerMethod] = explode('@', $this->routes[$method][$path]);
			$className = $this->controllerNamespace . '\\' . $controllerClass;
			$controllerInstance = new $className();
			return $controllerInstance->$handlerMethod($request);
		}

		// Handle 404 Not Found
		$response = new Response();
		$response = $response->withStatus(404);
		$response->getBody()->write('404 Not Found');

		return $response;
	}
}
