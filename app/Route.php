<?php

namespace App;

class Route
{
	private $routes;

	public function __construct()
	{
		$this->initRoutes();
		$this->run($this->getUrl());
	}

	public function initRoutes()
	{
		$routes['home'] = array('route'=>'/', 'controller'=>'indexController', 'action'=>index);
		$routes['contact'] = array('route'=>'/contact', 'controller'=>'indexController', 'action'=>contact);
		$this->setRoutes($routes);
	}

	//onde será setados as rotas.
	public function setRoutes()
	{
		$this->routes = $routes;
	}

	//estudar essa função depois
	public function run($url)
	{
		array_walk($this->routes, function($route) use ($url){
			if($url == $route['route']){
				$class = "App\\Controllers\\".ucfirst($route['controller']);
				$controller = new $class;
				$action = $route['action'];
				$controller->$action();
			}
		})
	}

	public function getUrl()
	{
		return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
	}

}