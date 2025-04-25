<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\EventsController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('events', 'EventsController::index');
$routes->post('api/v1/events/create', 'EventsController::create');