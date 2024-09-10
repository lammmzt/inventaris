<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


 // to enable auto routing
// $routes->setAutoRoute(true);

$routes->get('/', 'Home::index');


// auth route
$routes->group('Auth', function ($routes) {
        $routes->get('/', 'Auth::index');
        $routes->post('login', 'Auth::login');
        $routes->get('logout', 'Auth::logout');
    });
    

// group route admin
$routes->group('Admin', function ($routes) {
    $routes->get('Dashboard', 'Home::index');

    $routes->group('User', function ($routes) {
        $routes->get('/', 'usersController::index');
        $routes->get('DataTables', 'usersController::ajaxDataTables');
        $routes->post('save', 'usersController::store');
        $routes->post('delete', 'usersController::destroy');
        $routes->post('edit', 'usersController::edit');
        $routes->post('update', 'usersController::update');
        $routes->post('reset', 'usersController::reset');
        $routes->post('changeStatus', 'usersController::changeStatus');
        $routes->post('fetchDataUser', 'usersController::fetchDataUser');
        $routes->post('updatePass', 'usersController::updatePass');
    });

    $routes->group('Ruangan', function ($routes) {
        $routes->get('/', 'ruanganController::index');
        $routes->get('DataTables', 'ruanganController::ajaxDataTables');
        $routes->post('save', 'ruanganController::store');
        $routes->post('delete', 'ruanganController::destroy');
        $routes->post('edit', 'ruanganController::edit');
        $routes->post('update', 'ruanganController::update');
        $routes->post('updateStatus', 'ruanganController::changeStatus');
        $routes->post('fetchDataRuangan', 'ruanganController::fetchDataRuangan');
    });

    $routes->group('Satuan', function ($routes) {
        $routes->get('/', 'satuanController::index');
        $routes->get('DataTables', 'satuanController::ajaxDataTables');
        $routes->post('save', 'satuanController::store');
        $routes->post('delete', 'satuanController::destroy');
        $routes->post('edit', 'satuanController::edit');
        $routes->post('update', 'satuanController::update');
        $routes->post('updateStatus', 'satuanController::changeStatus');
        $routes->post('fetchDataSatuan', 'satuanController::fetchDataSatuan');
    });

    $routes->group('Barang', function ($routes) {
        $routes->get('/', 'barangController::index');
        $routes->get('getBarangByCode/(:segment)', 'barangController::getBarangByCode/$1');
        $routes->get('DataTables', 'barangController::ajaxDataTables');
        $routes->post('save', 'barangController::store');
        $routes->post('delete', 'barangController::destroy');
        $routes->post('edit', 'barangController::edit');
        $routes->post('update', 'barangController::update');
        $routes->post('updateStatus', 'barangController::changeStatus');
    });

    $routes->group('Barang/Detail', function ($routes) {
        $routes->get('(:segment)', 'tipeBarangController::index/$1');
        // $routes->get('/', 'tipeBarangController::index');
        $routes->post('DataTables', 'tipeBarangController::ajaxDataTables');
        $routes->post('save', 'tipeBarangController::store');
        $routes->post('delete', 'tipeBarangController::destroy');
        $routes->post('edit', 'tipeBarangController::edit');
        $routes->post('update', 'tipeBarangController::update');
        $routes->post('updateStatus', 'tipeBarangController::changeStatus');
    });

    $routes->group('ATK', function ($routes) {
        $routes->get('/', 'atkController::index');
        $routes->get('DataTables', 'atkController::ajaxDataTables');
        $routes->post('save', 'atkController::store');
        $routes->post('delete', 'atkController::destroy');
        $routes->post('edit', 'atkController::edit');
        $routes->post('update', 'atkController::update');
        $routes->post('changeStatus', 'atkController::changeStatus');
        $routes->post('fetchDataATK', 'atkController::fetchDataatk');
    });


    $routes->group('Setting', function ($routes) {
        $routes->get('/', 'usersController::Setting');
        $routes->post('update', 'usersController::update');
    });


});