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
$routes->get('permintaandetail/(:segment)', 'DapurController::detail/$1');
$routes->get('addPermintaan', 'DapurController::add');
$routes->post('/addPermintaan/store', 'DapurController::store');

    // Bahan Baku
    $routes->group('BahanBaku', function($routes) {
        $routes->get('display', 'BahanBaku::index');
        $routes->get('detail/(:segment)', 'BahanBaku::detail/$1');
        $routes->get('add', 'BahanBaku::add');
        $routes->post('store', 'BahanBaku::store');
        $routes->get('edit/(:segment)', 'BahanBaku::edit/$1');
        $routes->post('update/(:segment)', 'BahanBaku::update/$1');
        $routes->post('delete/(:segment)', 'BahanBaku::delete/$1');
        $routes->get('search', 'BahanBaku::search');
    });

    // Permintaan
    $routes->group('Permintaan', function($routes) {
        $routes->get('display', 'PermintaanController::index');
        $routes->get('search', 'PermintaanController::search');
        $routes->post('updateStatus', 'PermintaanController::updateStatus');
    });

    $routes->get('admin', 'AdminController::index');
