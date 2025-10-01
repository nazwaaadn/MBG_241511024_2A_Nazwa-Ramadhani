<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/job', 'JobController::index');
$routes->get('/login', 'AuthController::loginView');
$routes->post('/auth/loginProcess', 'AuthController::loginProcess');
$routes->post('/logout', 'AuthController::logout');
$routes->get('/gudang', 'GudangController::index');
$routes->get('/dapur', 'DapurController::index');

// Semua route untuk admin
$routes->group('', ['filter' => 'role:admin'], function($routes) {

    // Mahasiswa
        $routes->group('mahasiswa', function($routes) {
        $routes->get('table', 'Hello::index');
        $routes->get('detailmhs/(:segment)', 'Hello::detail/$1');
        $routes->get('add', 'Hello::add');
        $routes->post('store', 'Hello::store');
        $routes->get('edit/(:segment)', 'Hello::edit/$1');
        $routes->post('update/(:segment)', 'Hello::update/$1');
        $routes->get('delete/(:segment)', 'Hello::delete/$1');
        $routes->get('search', 'Hello::search');
        
        // route dari Auth
        $routes->get('homepage', 'Auth::homepage');
        $routes->get('detail/(:segment)', 'Auth::detail/$1');
    });

    $routes->get('admin', 'AdminController::index');

});
