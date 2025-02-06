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
    
    
    // Auth routes
    $routes->post('login', 'AuthController::login');

    // Protected routes (Requires authentication)
    $routes->group('', ['filter' => 'auth'], function ($routes) {
         // 🔹 Book Routes
    $routes->group('books', function ($routes) {
        $routes->get('/', 'BookController::index');
        $routes->post('/', 'BookController::create');
        $routes->get('(:num)', 'BookController::show/$1');
        $routes->put('(:num)', 'BookController::update/$1');
        $routes->delete('(:num)', 'BookController::delete/$1');
    });

    $routes->group('members', function ($routes) {
        $routes->get('/', 'MemberController::index');
        $routes->post('/', 'MemberController::create');
        $routes->get('(:num)', 'MemberController::show/$1');
        $routes->put('(:num)', 'MemberController::update/$1');
        $routes->delete('(:num)', 'MemberController::delete/$1');
    });


        $routes->get('admins', 'AdminController::index');
        $routes->post('admins', 'AdminController::create'); 
        $routes->get('admins/(:num)', 'AdminController::show/$1');
        $routes->put('admins/(:num)', 'AdminController::update/$1');
        $routes->delete('admins/(:num)', 'AdminController::delete/$1');
    });
});

