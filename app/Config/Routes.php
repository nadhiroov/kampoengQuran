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

// Santri
$routes->get('santri', 'Master\Santri::index');
$routes->get('santri/(:num)', 'Master\Santri::detail/$1');
$routes->post('santri/data', 'Master\Santri::getData');
$routes->get('santri/add', function () {
    return view('master/santri/add');
});
$routes->post('santri/process', 'Master\Santri::process');
$routes->delete('santri/(:num)', 'Master\Santri::delete/$1');

// Materi
$routes->get('materi', 'Master\Materi::index');
$routes->get('materi/(:num)', 'Master\Materi::detail/$1');
$routes->get('materi/edit/(:num)', 'Master\Materi::edit/$1');
$routes->post('materi', 'Master\Materi::getData');
$routes->post('detailMateri', 'Master\Materi::getDataDetail');
$routes->get('submateri/add/(:num)', 'Master\Materi::addSubmateri/$1');
$routes->get('submateri/edit/(:num)', 'Master\Materi::editSubmateri/$1');
$routes->get('submateri/add', function () {
    return view('master/materi/addSubmateri');
});
$routes->post('materi/process', 'Master\Materi::process');
$routes->post('submateri/process', 'Master\Materi::processSubmateri');
$routes->delete('materi/(:num)', 'Master\Materi::delete/$1');

// Kelas
$routes->get('kelas', 'Kelas::index');
$routes->get('kelas/add', 'Kelas::add');
$routes->post('kelas/process', 'Kelas::process');
$routes->get('kelas/addSantri/(:num)', 'Kelas::addSantri/$1');
$routes->delete('kelas/(:num)/(:num)', 'Kelas::deleteSantri/$1/$2');
$routes->post('kelas/processAddSantri', 'Kelas::processAddSantri');

// Jadwal
$routes->get('jadwal/add', function () {
    return view('jadwal/add');
});

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
    // kelas
    $routes->post('kelas', 'Kelas::getData');
    $routes->get('kelas/(:num)', 'Kelas::detail/$1');
    $routes->post('kelas/detailData/(:num)', 'Kelas::detailData/$1');
    
    // jadwal
    $routes->post('jadwal', 'Jadwal::getData');
});
