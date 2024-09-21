<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index');

// Admin
$routes->get('admin', 'Master\Admin::index');
$routes->get('admin/(:num)', 'Master\Admin::detail/$1');
$routes->get('admin/add', function(){
    return view('master/admin/add');
});
$routes->post('admin/process', 'Master\Admin::process');
$routes->delete('admin/(:num)', 'Master\Admin::delete/$1');

$routes->get('showImg/(:segment)/(:any)', function ($segment ,$filename) {
    $path = WRITEPATH . "uploads/$segment/$filename";
    if (file_exists($path)) {
        header('Content-Type: ' . mime_content_type($path));
        readfile($path);
        exit;
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
});


// $routes->resource('admin', ['controller' => 'User\Admin']);
$routes->group('api', static function ($routes) {
    $routes->post('auth', 'Auth::login');
    
    $routes->post('master/admin/data', 'Master\Admin::getData');
    
});