<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('admin', ['filter' => 'role:admin,superadmin'], function ($routes) {

    $routes->get('room-list', 'Room::roomList');
    $routes->post('insert-room', 'Room::insertRoom');
    $routes->post('edit-room', 'Room::editRoom');
    $routes->post('delete-room', 'Room::deleteRoom');

    $routes->get('tool-list', 'Tool::toolList');
    $routes->post('insert-tool', 'Tool::insertTool');
    $routes->post('edit-tool', 'Tool::editTool');
    $routes->post('delete-tool', 'Home::deleteTool');

    $routes->get('user-list', 'Home::userList');

    $routes->get('loan-list', 'Home::loanList');
});

$routes->get('room/(:segment)', 'Home::room/$1');
$routes->post('insert-loan', 'Home::insertLoan');

$routes->group('api', function ($routes) {
    // $routes->resource('room');
    // $routes->resource('tool');
    // $routes->resource('user');
    $routes->resource('loan');
});



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
