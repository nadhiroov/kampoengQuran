<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('ci', 'Home::index');
// $routes->resource('admin', ['controller' => 'User\Admin']);
$routes->group('api', static function ($routes) {
    $routes->post('auth', 'Auth::login');
});