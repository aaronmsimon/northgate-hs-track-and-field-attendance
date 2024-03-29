<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/','Home::index');
$routes->get('check-in', 'Home::index');
$routes->post('check-in', 'Home::checkin');
$routes->get('leaderboard', 'Leaderboard::index');
$routes->get('coaches','Coaches::index');
$routes->post('coaches/attendance-by-day','Coaches::attendancebyday');
$routes->post('coaches/roster','Coaches::roster');
$routes->get('athlete/(:segment)','Athlete::show/$1');
