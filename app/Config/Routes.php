<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


 // to enable auto routing
// $routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('getAllDataTras', 'transaksiController::ajaxDataTablesGetAllData');
$routes->get('DataTablesDashboardTrans', 'transaksiController::ajaxDataTablesDashboard');
$routes->get('getAllDataPengecekan', 'pengecekanController::ajaxDataTablesAll');
$routes->get('DataTablesGetAllPengadaan', 'pengadaanController::ajaxDataTablesGetAll');
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
        $routes->post('edit', 'transaksiController::edit');
        $routes->post('updateTransKeluar', 'transaksiController::updateTransKeluar');
        $routes->post('save', 'transaksiController::store');
        $routes->post('delete', 'transaksiController::destroy');
        $routes->post('edit', 'transaksiController::edit');
        $routes->post('update', 'transaksiController::update');
        $routes->post('changeStatus', 'transaksiController::changeStatus');
        $routes->post('fetchDataTransaksi', 'transaksiController::fetchDataTransaksi');
        $routes->post('fetchDataTransaksiById', 'transaksiController::fetchDataTransaksiById');

        // ================== TRANSAKSI MASUK ==================
        $routes->get('Masuk', 'detailTransaksiController::transaksi_masuk');
        $routes->post('insertTransaksiMasuk', 'detailTransaksiController::insertTransaksiMasuk');
        $routes->post('fetchDetailTransByIdTrans', 'detailTransaksiController::fetchDetailTransByIdTrans');
        $routes->get('Masuk/(:segment)', 'detailTransaksiController::edit_trans_masuk/$1');
        // $routes->get('DataTablesEditTransMasuk', 'detailTransaksiController::ajaxDataTablesMasuk');
        $routes->post('DataTablesEditTransMasuk', 'detailTransaksiController::ajaxDataTablesMasuk');
        $routes->post('deleteTransMasuk', 'detailTransaksiController::destroyTransMasuk');
        $routes->post('updateDetailATKMasuk', 'detailTransaksiController::updateDetailATKMasuk');
        $routes->post('updateQtyMasuk', 'detailTransaksiController::updateQtyMasuk');
        $routes->post('updatePenerimaanTransMasuk', 'detailTransaksiController::updatePenerimaanTransMasuk');
        $routes->get('Masuk/Proses/(:segment)', 'detailTransaksiController::proses_penerimaan');
        
        // ================== TRANSAKSI KELUAR ==================
        $routes->get('Keluar', 'detailTransaksiController::transaksi_keluar');
        $routes->post('insertTransaksiKeluar', 'detailTransaksiController::insertTransaksiKeluar');
        $routes->get('Keluar/(:segment)', 'detailTransaksiController::edit_trans_keluar/$1');
        $routes->get('Keluar/Proses/(:segment)', 'detailTransaksiController::proses_trans_keluar/$1');
        
        // $routes->get('DataTablesEditTransKeluar', 'detailTransaksiController::ajaxDataTablesKeluar');
        $routes->post('DataTablesEditTransKeluar', 'detailTransaksiController::ajaxDataTablesKeluar');
        $routes->post('deleteTransKeluar', 'detailTransaksiController::destroyTransKeluar');
        $routes->post('updateDetailATKKeluar', 'detailTransaksiController::updateDetailATKKeluar');
        $routes->post('updateQtyKeluar', 'detailTransaksiController::updateQtyKeluar');
        $routes->post('updatedCatatan', 'detailTransaksiController::updatedCatatan');
        $routes->post('UpdateprosesTransKeluar', 'detailTransaksiController::UpdateprosesTransKeluar');
        
    });
    
    $routes->group('Inventaris', function ($routes) {
        $routes->get('/', 'inventarisController::index');
        $routes->get('DataTables', 'inventarisController::ajaxDataTables');
        $routes->post('save', 'inventarisController::store');
        $routes->post('delete', 'inventarisController::destroy');
        $routes->post('edit', 'inventarisController::edit');    
        $routes->post('update', 'inventarisController::update');
        $routes->post('changeStatus', 'inventarisController::changeStatus');
        $routes->post('fetchDatainventaris', 'inventarisController::fetchDatainventaris');
        $routes->post('Import', 'inventarisController::importData');
        $routes->post('pritnQrCode', 'inventarisController::pritnQrCode');
        $routes->get('Pelaporan', 'pengecekanController::Pelaporan');
        $routes->post('fetchInventarisByKodeInventaris', 'pengecekanController::fetchInventarisByKodeInventaris');
        $routes->post('Pelaporan/save', 'pengecekanController::store');
    });
    
    $routes->group('Pengadaan', function ($routes) {
        $routes->get('/', 'pengadaanController::index');
        $routes->get('Tambah', 'pengadaanController::tambah_pengadaan');
        $routes->get('DataTables', 'pengadaanController::ajaxDataTables');
        $routes->post('save', 'detailPengadaanController::store');
        $routes->post('delete', 'detailPengadaanController::destroy');
        $routes->post('edit', 'pengadaanController::edit');
        $routes->post('update', 'PengadaanController::update');
        $routes->post('fetchAll', 'pengadaanController::fetchAll');
        $routes->post('fetchPengadaanById', 'detailPengadaanController::fetchPengadaanById');
        $routes->get('(:segment)', 'detailPengadaanController::edit_pengadaan/$1');
        $routes->post('DataTablesDetailPengadaan', 'detailPengadaanController::ajaxDataTables');
        $routes->post('updatePengadaan', 'detailPengadaanController::updateDetail');
        $routes->post('updateQty', 'detailPengadaanController::updateQty');
        $routes->post('updateCatatan', 'detailPengadaanController::updateCatatan');
        $routes->post('updateSpek', 'detailPengadaanController::updateSpek');
        $routes->post('Delete', 'detailPengadaanController::destroyPengadaan');
        
        $routes->get('Proses/(:segment)', 'detailPengadaanController::proses_penerimaan/$1');
        $routes->post('UpdateProsesPenerimaan', 'detailPengadaanController::UpdateProsesPenerimaan');
    });
    
    $routes->group('Setting', function ($routes) {
        $routes->get('/', 'usersController::Setting');
        $routes->post('update', 'usersController::update');
    });

    $routes->group('Laporan', function ($routes) {
        $routes->get('Inventaris', 'laporanController::laproranInventaris');
        $routes->post('ajaxLaporanInventaris', 'laporanController::ajaxLaporanInventaris');

        $routes->get('Transaksi', 'laporanController::laporanTransaksi');
        $routes->post('ajaxLaporanTransaksi', 'laporanController::ajaxLaporanTransaksi');
    });

});

// group route Pegawai
// $routes->group('Pegawai', function ($routes) {
//     $routes->get('Dashboard', 'Home::Pegawai');
//     $routes->group('Transaksi', function ($routes) {
//         $routes->get('/', 'transaksiController::transaksi_keluar');
//     });
// });

// group route Ka TU
$routes->group('KaTU', function ($routes) {
    $routes->get('Dashboard', 'Home::ka_tu');
    
    $routes->group('ATK/Transaksi', function ($routes) {
        $routes->get('/', 'transaksiController::prosesSetujuTransaksi');
        $routes->get('DataTablesProsesSetuju', 'transaksiController::ajaxDataTablesProsesSetuju');
        $routes->get('Proses/(:segment)', 'detailTransaksiController::proses_setuju/$1');
        $routes->post('UpdateProsesPersetujuan', 'detailTransaksiController::UpdateProsesPersetujuan');
    });
    $routes->group('Pengadaan', function ($routes) {
        $routes->get('/', 'pengadaanController::persetujuan_pengadaan');
        $routes->get('DataTablesProsesSetuju', 'pengadaanController::ajaxDataTablesProsesSetuju');
        $routes->get('Proses/(:segment)', 'detailPengadaanController::persetujuan_pengadaan/$1');
        $routes->post('UpdateProsesPersetujuan', 'detailPengadaanController::UpdateProsesPersetujuan');
    });

    $routes->get('Setting','usersController::Setting');
});

// group route petugasBOS
$routes->group('PetugasBOS', function ($routes) {
    $routes->get('Dashboard', 'Home::petugas_bos');
    
    $routes->group('ATK/Transaksi', function ($routes) {
        $routes->get('/', 'transaksiController::peroses_pengadaan');
        $routes->get('DataTablesProsesPengadaan', 'transaksiController::ajaxDataTablesProsesPengadaan');
        $routes->get('Proses/(:segment)', 'detailTransaksiController::proses_pengadaan/$1');
        $routes->post('UpdateProsesPengadaan', 'detailTransaksiController::UpdateProsesPengadaan');
    });
    
    $routes->group('Pengadaan', function ($routes) {
        $routes->get('/', 'pengadaanController::peroses_pengadaan');
        $routes->get('DataTablesProsesPengadaan', 'pengadaanController::ajaxDataTablesProsesPengadaan');
        $routes->get('Proses/(:segment)', 'detailPengadaanController::proses_pengadaan/$1');
    });

    $routes->get('Setting','usersController::Setting');

    $routes->group('Laporan', function ($routes) {
        $routes->get('Inventaris', 'laporanController::laproranInventaris');

        $routes->get('Transaksi', 'laporanController::laporanTransaksi');
    });
});

// group route Pegawai
$routes->group('Pegawai', function ($routes) {
    $routes->get('Dashboard', 'Home::Pegawai');
    
    $routes->group('ATK/Transaksi', function ($routes) {
        $routes->get('/', 'transaksiController::transaksi_pegawai');
        $routes->get('DataTablesPegawai', 'transaksiController::ajaxDataTablesPegawai');
        $routes->get('Keluar', 'detailTransaksiController::transaksi_keluar_pegawai');
        $routes->post('insertTransaksiPegawai', 'detailTransaksiController::insertTransaksiPegawai');
        $routes->get('Keluar/(:segment)', 'detailTransaksiController::edit_trans_keluar_pegawai/$1');
    });

    $routes->group('Inventaris', function ($routes) {
        $routes->get('Pelaporan', 'pengecekanController::Pelaporan');
        $routes->post('fetchInventarisByKodeInventaris', 'pengecekanController::fetchInventarisByKodeInventaris');
        $routes->post('Pelaporan/save', 'pengecekanController::store');
    });

    $routes->get('Setting','usersController::Setting');
});

// group route Kepala Sekolah
$routes->group('Kepsek', function ($routes) {
    $routes->get('Dashboard', 'Home::Kepsek');
    
    $routes->group('Laporan', function ($routes) {
        $routes->get('Inventaris', 'laporanController::laproranInventaris');
        $routes->get('Transaksi', 'laporanController::laporanTransaksi');
    });

    $routes->get('Setting','usersController::Setting');
});