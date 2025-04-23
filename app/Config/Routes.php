<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Page::login_user');

$routes->get('login-admin', 'Page::login');
$routes->get('login-user', 'Page::login_user');
$routes->get('register', 'Page::register');
$routes->get('dashboard_user', "Page::dashboard_user");
$routes->get('ebook', 'Page::ebook');
$routes->get('profile', 'Page::profile');
$routes->get('beranda', 'Page::beranda');
<<<<<<< HEAD
$routes->get('anggota','Page::data_anggota');
=======
$routes->get('anggota', 'Page::data_anggota');
>>>>>>> a20072ad46a2a69587f0fd41306bebfd478e87ef
$routes->get('buku', 'Page::data_buku');
$routes->get('buku/tambah_buku', 'Page::tambah_buku');
$routes->get('buku/edit_buku', 'Page::edit_buku');
$routes->get('anggota/tambah_anggota', "Page::tambah_anggota");
$routes->get('anggota/edit_anggota', "Page::edit_anggota");
$routes->get('pdf/viewIframe/(:any)', 'PdfController::viewIframe/$1');
$routes->get('pdf/display/(:any)', 'PdfController::display/$1');



// API
$routes->get('/api', 'ApiController::index');
$routes->get('/api/hello/(:any)', 'ApiController::hello/$1');


$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
<<<<<<< HEAD
    
    
=======


>>>>>>> a20072ad46a2a69587f0fd41306bebfd478e87ef
    // Auth routes
    $routes->post('login', 'AuthController::login');

    $routes->get('admins', 'AdminController::index');
<<<<<<< HEAD
    $routes->post('admins', 'AdminController::create'); 
=======
    $routes->post('admins', 'AdminController::create');
>>>>>>> a20072ad46a2a69587f0fd41306bebfd478e87ef
    $routes->get('admins/(:num)', 'AdminController::show/$1');
    $routes->put('admins/(:num)', 'AdminController::update/$1');
    $routes->delete('admins/(:num)', 'AdminController::delete/$1');

    // Protected routes (Requires authentication)
    $routes->group('', ['filter' => 'auth'], function ($routes) {
<<<<<<< HEAD
         // 🔹 Book Routes
    $routes->group('books', function ($routes) {
        $routes->get('/', 'BookController::index');
        $routes->post('/', 'BookController::create');
        $routes->get('(:num)', 'BookController::show/$1');
        $routes->put('(:num)', 'BookController::update/$1');
        $routes->delete('(:num)', 'BookController::delete/$1');
        $routes->post('(:num)/upload-cover', 'BookController::uploadCover/$1');
        $routes->post('(:num)/upload-pdf', 'BookController::uploadPDF/$1');
    });

    $routes->group('members', function ($routes) {
        $routes->get('/', 'MemberController::index');
        $routes->post('/', 'MemberController::create');
        $routes->get('(:num)', 'MemberController::show/$1');
        $routes->put('(:num)', 'MemberController::update/$1');
        $routes->delete('(:num)', 'MemberController::delete/$1');
        $routes->post('(:num)/upload-profile-picture', 'MemberController::uploadProfilePicture/$1');
    });
=======
        // 🔹 Book Routes
        $routes->group('books', function ($routes) {
            $routes->get('/', 'BookController::index');
            $routes->post('/', 'BookController::create');
            $routes->get('(:num)', 'BookController::show/$1');
            $routes->put('(:num)', 'BookController::update/$1');
            $routes->delete('(:num)', 'BookController::delete/$1');
            $routes->post('(:num)/upload-cover', 'BookController::uploadCover/$1');
            $routes->post('(:num)/upload-pdf', 'BookController::uploadPDF/$1');
            $routes->get('buku/printPDF', 'BookController::printPDF');
        });

        $routes->group('members', function ($routes) {
            $routes->get('/', 'MemberController::index');
            $routes->post('/', 'MemberController::create');
            $routes->get('(:num)', 'MemberController::show/$1');
            $routes->put('(:num)', 'MemberController::update/$1');
            $routes->delete('(:num)', 'MemberController::delete/$1');
            $routes->post('(:num)/upload-profile-picture', 'MemberController::uploadProfilePicture/$1');
        });
>>>>>>> a20072ad46a2a69587f0fd41306bebfd478e87ef
    });
});
