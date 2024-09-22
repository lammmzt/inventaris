<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\filterPetugasBOS;
use App\Filters\filterPegawai;
use App\Filters\filterAdmin;
use App\Filters\filterKaTU;
use App\Filters\filterKepsek;
use App\Filters\Middleware;

class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>>
     *
     * [filter_name => classname]
     * or [filter_name => [classname1, classname2, ...]]
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'filterPetugasBOS' => filterPetugasBOS::class,
        'filterPegawai' => filterPegawai::class,
        'filterAdmin' => filterAdmin::class,
        'filterKaTU' => filterKaTU::class,
        'filterKepsek' => filterKepsek::class,
        'Middleware' => Middleware::class,
    ];

    /**
     * List of special required filters.
     *
     * The filters listed here are special. They are applied before and after
     * other kinds of filters, and always applied even if a route does not exist.
     *
     * Filters set by default provide framework functionality. If removed,
     * those functions will no longer work.
     *
     * @see https://codeigniter.com/user_guide/incoming/filters.html#provided-filters
     *
     * @var array{before: list<string>, after: list<string>}
     */
    public array $required = [
        'before' => [
            'forcehttps', // Force Global Secure Requests
            'pagecache',  // Web Page Caching
        ],
        'after' => [
            'pagecache',   // Web Page Caching
            'performance', // Performance Metrics
            'toolbar',     // Debug Toolbar
        ],
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
    public array $globals = [
        'before' => [
            'Middleware' => ['except' => ['Auth','Auth/*',]],
        ],
        'after' => [
            'filterAdmin' => ['except' => [ 
                '/', 'Auth/logout', 'Auth/login','Admin/Dashboard', 'Admin/Barang', 'Admin/Barang*', 'Admin/Ruangan', 'Admin/Ruangan/*', 'Admin/Satuan', 'Admin/Satuan/*', 'Admin/ATK', 'Admin/ATK/*', 'Admin/Inventaris', 'Admin/Inventaris/*', 'Admin/Pengadaan', 'Admin/Pengadaan/*', 'Admin/User', 'Admin/User/*', 'Admin/Laporan', 'Admin/Laporan/*', 'Admin/Setting', 
            ]],
            'filterKaTU' => ['except' => [ 
                '/', 'Auth/logout','Auth/login', 'KaTU/Dashboard', 'KaTu/ATK/Transaksi', 'KaTu/ATK/Transaksi/*', 'KaTu/Pengadaan', 'KaTu/Pengadaan/*', 'Admin/ATK/Transaksi/DataTablesKeluar', 'Admin/ATK/Transaksi/edit', 'Admin/ATK/Transaksi/fetchDetailTransByIdTrans','Admin/ATK/Transaksi/edit', 'Admin/ATK/Transaksi/fetchDetailTransByIdTrans','Admin/ATK/Transaksi/DataTablesEditTransKeluar', 'Admin/ATK/Transaksi/updateQtyMasuk', 'Admin/ATK/Transaksi/updatedCatatan', 'Admin/Pengadaan/edit', 'Admin/Pengadaan/fetchPengadaanById', 'Admin/Pengadaan/DataTablesDetailPengadaan', 'Admin/Barang/Detail/fetchTipeBarangByJenisBarang', 'Admin/Pengadaan/Delete', 'Admin/Pengadaan/updatePengadaan', 'Admin/Pengadaan/updateQty', 'Admin/Pengadaan/updateSpek', 'Admin/Pengadaan/updateCatatan','Admin/User/updatePass', 'Admin/User/fetchDataUser', 'Admin/Setting', 'Admin/Laporan/', 'Admin/Laporan/*'
            ]],
            'filterPetugasBOS' => ['except' => [    
                '/', 'Auth/logout','Auth/login', 'PetugasBOS/Dashboard', 'PetugasBOS/ATK/Transaksi', 'PetugasBOS/ATK/Transaksi/*', 'PetugasBOS/Pengadaan', 'PetugasBOS/Pengadaan/*', 'Admin/ATK/Transaksi/DataTablesEditTransMasuk', 'Admin/ATK/Transaksi/edit', 'Admin/ATK/Transaksi/fetchDetailTransByIdTrans','Admin/ATK/Transaksi/edit', 'Admin/ATK/Transaksi/fetchDetailTransByIdTrans','Admin/ATK/Transaksi/DataTablesEditTransKeluar', 'Admin/ATK/Transaksi/updateQtyMasuk', 'Admin/ATK/Transaksi/updatedCatatan', 'Admin/Pengadaan/edit', 'Admin/Pengadaan/fetchPengadaanById', 'Admin/Pengadaan/DataTablesDetailPengadaan', 'Admin/Barang/Detail/fetchTipeBarangByJenisBarang', 'Admin/Pengadaan/Delete', 'Admin/Pengadaan/updatePengadaan', 'Admin/Pengadaan/updateQty', 'Admin/Pengadaan/updateSpek', 'Admin/Pengadaan/updateCatatan', 'Admin/Pengadaan/UpdateProsesPenerimaan', 'Admin/ATK/Transaksi/updateQtyKeluar', 'Admin/User/updatePass', 'Admin/User/fetchDataUser', 'Admin/Setting'
            ]],
            'filterPegawai' => ['except' => [    
                '/', 'Auth/logout','Auth/login', 'Pegawai/Dashboard', 'Pegawai/ATK/Transaksi', 'Pegawai/ATK/Transaksi/*', 'Pegawai/Inventaris', 'Pegawai/Inventaris/*', 'Admin/ATK/Transaksi/DataTablesEditTransMasuk', 'Admin/ATK/Transaksi/edit', 'Admin/ATK/Transaksi/fetchDetailTransByIdTrans','Admin/ATK/Transaksi/edit', 'Admin/ATK/Transaksi/fetchDetailTransByIdTrans','Admin/ATK/Transaksi/DataTablesEditTransKeluar', 'Admin/ATK/Transaksi/updateQtyMasuk', 'Admin/ATK/Transaksi/updatedCatatan', 'Admin/ATK/fetchAll', 'Admin/ATK/,Transaksi/DataTablesEditTransKeluar', 'Admin/ATK/Transaksi/deleteTransKeluar', 'Admin/ATK/Transaksi/updateDetailATKKeluar', 'Admin/ATK/Transaksi/insertTransaksiKeluar', 'Admin/ATK/Transaksi/updateTransKeluar', 'Admin/Inventaris/fetchInventarisByKodeInventaris', 'Admin/Inventaris/Pelaporan/save','Admin/User/updatePass', 'Admin/User/fetchDataUser', 'Admin/Setting'
            ]],
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'POST' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     *
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [];
}