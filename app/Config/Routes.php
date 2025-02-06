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
$routes->get('/api/hello/(:any)','ApiController::hello/$1');


$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('admins', 'AdminController::create'); // Move it here temporarily

    // Auth routes
    $routes->post('login', 'AuthController::login');
    $routes->post('register', 'AuthController::register');

    // Protected routes (Requires authentication)
    $routes->group('', ['filter' => 'auth'], function ($routes) {
        $routes->get('books', 'BookController::index');
        $routes->post('books', 'BookController::create');
        $routes->get('books/(:num)', 'BookController::show/$1');
        $routes->put('books/(:num)', 'BookController::update/$1');
        $routes->delete('books/(:num)', 'BookController::delete/$1');

        $routes->get('admins', 'AdminController::index');
        $routes->get('admins/(:num)', 'AdminController::show/$1');
        $routes->put('admins/(:num)', 'AdminController::update/$1');
        $routes->delete('admins/(:num)', 'AdminController::delete/$1');
    });
});

