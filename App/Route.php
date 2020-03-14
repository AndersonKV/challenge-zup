<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap
{

	protected function initRoutes()
	{


		$routes['index'] = array(
			'route' => '/',
			'controller' => 'IndexController',
			'action' => 'index'
		);

		$routes['register'] = array(
			'route' => '/register',
			'controller' => 'IndexController',
			'action' => 'register'
		);

		$routes['login'] = array(
			'route' => '/login',
			'controller' => 'IndexController',
			'action' => 'login'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AppController',
			'action' => 'sair'
		);
		$routes['home'] = array(
			'route' => '/home',
			'controller' => 'AppController',
			'action' => 'home'
		);
		$routes['search'] = array(
			'route' => '/search',
			'controller' => 'AppController',
			'action' => 'search'
		);

		$routes['trash'] = array(
			'route' => '/trash',
			'controller' => 'AppController',
			'action' => 'trash'
		);
		$routes['setTrash'] = array(
			'route' => '/setTrash',
			'controller' => 'AppController',
			'action' => 'setTrash'
		);
		$routes['todo'] = array(
			'route' => '/todo',
			'controller' => 'AppController',
			'action' => 'todo'
		);
		$routes['setTodo'] = array(
			'route' => '/setTodo',
			'controller' => 'AppController',
			'action' => 'setTodo'
		);
		$routes['attended'] = array(
			'route' => '/attended',
			'controller' => 'AppController',
			'action' => 'attended'
		);
		$routes['setAttended'] = array(
			'route' => '/setAttended',
			'controller' => 'AppController',
			'action' => 'setAttended'
		);
		$routes['screen'] = array(
			'route' => '/screen',
			'controller' => 'AppController',
			'action' => 'screen'
		);
		$routes['action'] = array(
			'route' => '/action',
			'controller' => 'AppController',
			'action' => 'action'
		);

		$routes['error'] = array(
			'route' => '/error',
			'controller' => 'IndexController',
			'action' => 'error'
		);

		$this->setRoutes($routes);
	}
}
