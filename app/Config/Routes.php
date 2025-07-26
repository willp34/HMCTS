<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/bulkAdd', 'Home::bulkAdd');

/**
* team pages
*/

$routes->group('api', function($routes){
	
	$routes->get('getTasks', 'Api\Tasks::getTasks');
	
	$routes->post('addTask', 'Api\Tasks::create');
	
	$routes->get('deleteTask/(:num)', 'Api\Tasks::deleteTask/$1');
	
	
	
	$routes->put('editTask/(:num)', 'Api\Tasks::editTask/$1');
	
	
});





## User pages



$routes->get('/api/users/(:num)/(:segment)', 'Api\User::getUsers/$1/$2');
 
