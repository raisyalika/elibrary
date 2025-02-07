<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Page::about');
$routes->get('contact', 'Page::contact');
$routes->get('login', 'page::login');
$routes->get('register', 'page::register');
$routes->get('dashboard_user', "page::dashboard_user");
$routes->get('ebook', 'page::ebook');
$routes->get('profile', 'page::profile');
$routes->get('beranda', 'page::beranda');
$routes->get('anggota','page::data_anggota');
$routes->get('buku', 'page::data_buku');
$routes->get('buku/tambah_buku', 'page::tambah_buku');
$routes->get('buku/edit_buku', 'page::edit_buku');
$routes->get('anggota/tambah_anggota', "page::tambah_anggota");
$routes->get('anggota/edit_anggota', "page::edit_anggota");

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

