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

    $routes->group('Setting', function ($routes) {
        $routes->get('/', 'usersController::Setting');
        $routes->post('update', 'usersController::update');
    });


});