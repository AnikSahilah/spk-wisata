<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

// Simulasi dashboard berdasarkan role
$routes->get('/super-admin/dashboard', 'SuperAdmin::dashboard', ['filter' => 'role:super_admin']);
$routes->get('/admin/dashboard', 'DashboardAdminController::index', ['filter' => 'role:admin']);

$routes->get('rekomendasi/filter-form', 'RekomendasiController::filterForm');  // Menampilkan form filter
$routes->post('rekomendasi', 'RekomendasiController::index');                 // Proses filter dan tampilkan hasil JSON

$routes->group('admin/kriteria', [
    'namespace' => 'App\Controllers',
    'filter' => 'role:admin'
], function ($routes) {
    $routes->get('/', 'KriteriaController::index'); // /admin/kriteria
    $routes->get('create', 'KriteriaController::create'); // /admin/kriteria/create
    $routes->post('store', 'KriteriaController::store'); // /admin/kriteria/store
    $routes->get('edit/(:num)', 'KriteriaController::edit/$1'); // /admin/kriteria/edit/1
    $routes->post('update/(:num)', 'KriteriaController::update/$1'); // /admin/kriteria/update/1
    $routes->post('delete/(:num)', 'KriteriaController::destroy/$1'); // /admin/kriteria/delete/1
});

$routes->group('admin/sub-kriteria', [
    'namespace' => 'App\Controllers',
    'filter' => 'role:admin'
], function ($routes) {
    $routes->get('/', 'SubKriteriaController::index', ['as' => 'subkriteria.index']);
    $routes->get('create', 'SubKriteriaController::create', ['as' => 'subkriteria.create']);
    $routes->post('store', 'SubKriteriaController::store', ['as' => 'subkriteria.store']);
    $routes->get('edit/(:num)', 'SubKriteriaController::edit/$1', ['as' => 'subkriteria.edit']);
    $routes->post('update/(:num)', 'SubKriteriaController::update/$1', ['as' => 'subkriteria.update']);
    $routes->post('delete/(:num)', 'SubKriteriaController::destroy/$1', ['as' => 'subkriteria.delete']);
});

$routes->group('admin/wisata', [
    'namespace' => 'App\Controllers',
    'filter' => 'role:admin' // ⬅ tambahkan ini
], function ($routes) {
    $routes->get('/', 'WisataController::index');
    $routes->get('create', 'WisataController::create');
    $routes->post('store', 'WisataController::store');
    $routes->get('edit/(:num)', 'WisataController::edit/$1');
    $routes->post('update/(:num)', 'WisataController::update/$1');
    $routes->post('delete/(:num)', 'WisataController::delete/$1');
});

$routes->group('admin/nilai-alternatif', [
    'namespace' => 'App\Controllers',
    'filter' => 'role:admin' // ⬅ tambahkan ini
], function ($routes) {
    $routes->get('/', 'NilaiAlternatifController::index');
    $routes->get('create', 'NilaiAlternatifController::create');
    $routes->post('store', 'NilaiAlternatifController::store');
    $routes->get('edit/(:num)', 'NilaiAlternatifController::edit/$1');
    $routes->post('update/(:num)', 'NilaiAlternatifController::update/$1');
    $routes->post('delete/(:num)', 'NilaiAlternatifController::delete/$1');
});
