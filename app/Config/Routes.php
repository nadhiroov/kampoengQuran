<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('admin', 'Master\Admin::index');



// $routes->resource('admin', ['controller' => 'User\Admin']);
$routes->group('api', static function ($routes) {
    $routes->post('auth', 'Auth::login');
    
    $routes->post('master/admin/data', 'Master\Admin::getData');
    
});