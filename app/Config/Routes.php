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
$routes->post('admin/data', 'Master\Admin::getData');
$routes->get('admin/add', function () {
    return view('master/admin/add');
});
$routes->post('admin/process', 'Master\Admin::process');
$routes->delete('admin/(:num)', 'Master\Admin::delete/$1');

// Ustadz
$routes->get('ustadz', 'Master\Ustadz::index');
$routes->get('ustadz/(:num)', 'Master\Ustadz::detail/$1');
$routes->post('ustadz/data', 'Master\Ustadz::getData');
$routes->get('ustadz/add', function () {
    return view('master/ustadz/add');
});
$routes->post('ustadz/process', 'Master\Ustadz::process');
$routes->delete('ustadz/(:num)', 'Master\Ustadz::delete/$1');

// santri
$routes->get('santri', 'Master\Santri::index');
$routes->get('santri/(:num)', 'Master\Santri::detail/$1');
$routes->post('santri/data', 'Master\Santri::getData');
$routes->get('santri/add', function () {
    return view('master/santri/add');
});
$routes->post('santri/process', 'Master\Santri::process');
$routes->delete('santri/(:num)', 'Master\Santri::delete/$1');

// kelas
$routes->get('kelas', 'Master\Kelas::index');
$routes->get('kelas/add', 'Master\Kelas::add');
$routes->post('kelas/process', 'Master\Kelas::process');
$routes->get('kelas/addSantri/(:num)', 'Master\Kelas::addSantri/$1');
$routes->delete('kelas/(:num)/(:num)', 'Master\Kelas::deleteSantri/$1/$2');
$routes->post('kelas/processAddSantri', 'Master\Kelas::processAddSantri');


// Show image
$routes->get('showImg/(:segment)/(:any)', function ($segment, $filename) {
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
    $routes->post('kelas/data', 'Master\Kelas::getData');
    $routes->get('kelas/(:num)', 'Master\Kelas::detail/$1');
    $routes->post('kelas/detailData/(:num)', 'Master\Kelas::detailData/$1');
});
