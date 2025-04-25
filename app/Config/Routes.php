<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\EventController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('events', 'EventController::index');
$routes->post('api/v1/events/create', 'EventController::create');