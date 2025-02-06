<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('about', 'Page::about');
$routes->get('contact', 'Page::contact');

// API
$routes->get('/api','ApiController::index');
$routes->get('/api/hello/(:any)/','ApiController::hello/$1');
