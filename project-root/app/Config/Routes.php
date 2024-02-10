<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/','Home::index');
$routes->get('check-in', 'Home::index');
$routes->post('check-in', 'Home::checkin');
