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
        $routes->post('fetchAll', 'usersController::fetchAll');
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
        $routes->post('fetchAll', 'ruanganController::fetchAll');
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
        $routes->post('fetchAll', 'satuanController::fetchAll');
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
        $routes->post('fetchBarangByJenisBarang', 'barangController::fetchBarangByJenisBarang');
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
        $routes->post('fetchAll', 'tipeBarangController::fetchAll');
        $routes->post('fetchTipeBarangByJenisBarang', 'tipeBarangController::fetchTipeBarangByJenisBarang');
        $routes->post('fetchTipeBarangByIdBarang', 'tipeBarangController::fetchTipeBarangByIdBarang');
    });

    $routes->group('ATK', function ($routes) {
        $routes->get('/', 'atkController::index');
        $routes->get('DataTables', 'atkController::ajaxDataTables');
        $routes->post('save', 'atkController::store');
        $routes->post('delete', 'atkController::destroy');
        $routes->post('edit', 'atkController::edit');
        $routes->post('update', 'atkController::update');
        $routes->post('changeStatus', 'atkController::changeStatus');
        $routes->post('fetchAll', 'atkController::fetchAll');
        $routes->post('fetchDataATK', 'atkController::fetchDataatk');
    });

    $routes->group('ATK/Transaksi', function ($routes) {
        $routes->get('/', 'transaksiController::index');
        $routes->get('DataTablesMasuk', 'transaksiController::ajaxDataTablesMasuk');
        $routes->get('DataTablesKeluar', 'transaksiController::ajaxDataTablesKeluar');
        $routes->post('updateTransMasuk', 'transaksiController::updateTransMasuk');
        $routes->post('updateTransKeluar', 'transaksiController::updateTransKeluar');

        // transaksi masuk
        $routes->get('Masuk', 'detailTransaksiController::transaksi_masuk');
        $routes->post('insertTransaksiMasuk', 'detailTransaksiController::insertTransaksiMasuk');
        $routes->post('fetchDetailTransByIdTrans', 'detailTransaksiController::fetchDetailTransByIdTrans');
        $routes->get('Masuk/(:segment)', 'detailTransaksiController::edit_trans_masuk/$1');
        // $routes->get('DataTablesEditTransMasuk', 'detailTransaksiController::ajaxDataTablesMasuk');
        $routes->post('DataTablesEditTransMasuk', 'detailTransaksiController::ajaxDataTablesMasuk');
        $routes->post('deleteTransMasuk', 'detailTransaksiController::destroyTransMasuk');
        $routes->post('updateDetailATKMasuk', 'detailTransaksiController::updateDetailATKMasuk');
        $routes->post('updateQtyMasuk', 'detailTransaksiController::updateQtyMasuk');

        // transaksi Keluar
        $routes->get('Keluar', 'detailTransaksiController::transaksi_keluar');
        $routes->post('insertTransaksiKeluar', 'detailTransaksiController::insertTransaksiKeluar');
        $routes->get('Keluar/(:segment)', 'detailTransaksiController::edit_trans_keluar/$1');
        // $routes->get('DataTablesEditTransKeluar', 'detailTransaksiController::ajaxDataTablesKeluar');
        $routes->post('DataTablesEditTransKeluar', 'detailTransaksiController::ajaxDataTablesKeluar');
        $routes->post('deleteTransKeluar', 'detailTransaksiController::destroyTransKeluar');
        $routes->post('updateDetailATKKeluar', 'detailTransaksiController::updateDetailATKKeluar');
        $routes->post('updateQtyKeluar', 'detailTransaksiController::updateQtyKeluar');

        
        $routes->post('save', 'transaksiController::store');
        $routes->post('delete', 'transaksiController::destroy');
        $routes->post('edit', 'transaksiController::edit');
        $routes->post('update', 'transaksiController::update');
        $routes->post('changeStatus', 'transaksiController::changeStatus');
        $routes->post('fetchDataTransaksi', 'transaksiController::fetchDataTransaksi');
        $routes->post('fetchDataTransaksiById', 'transaksiController::fetchDataTransaksiById');


    });


    $routes->group('Setting', function ($routes) {
        $routes->get('/', 'usersController::Setting');
        $routes->post('update', 'usersController::update');
    });


});