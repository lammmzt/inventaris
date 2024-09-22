<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\inventarisModel;
use App\Models\atkModel;
use App\Models\transaksiModel;
use App\Models\detailTransaksiModel;
use Ramsey\Uuid\Uuid;

class laporanController extends BaseController
{
    protected $inventarisModel;
    protected $atkModel;
    protected $transaksiModel;
    protected $detailTransaksiModel;

    public function __construct()
    {
        $this->inventarisModel = new inventarisModel();
        $this->atkModel = new atkModel();
        $this->transaksiModel = new transaksiModel();
        $this->detailTransaksiModel = new detailTransaksiModel();
    }

    
    public function laproranInventaris()
    {
        $data = [
            'main_menu' => 'Laporan',
            'title' => 'Laporan Inventaris',
            'active' => 'laporan_inventaris',
        ];
        return view('laporan/inventaris', $data);
    }


    public function ajaxLaporanInventaris()
    {
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        if($tgl_awal == null || $tgl_akhir == null){
            $tgl_awal = 0;
            $tgl_akhir = 0;
        }
        $builder = $this->inventarisModel->getInventaris()->where('perolehan_inventaris >=', $tgl_awal)->where('perolehan_inventaris <=', $tgl_akhir);

        return DataTable::of($builder)
        
        ->toJson(true);
    }

    public function laporanTransaksi()
    {
        $data = [
            'main_menu' => 'Laporan',
            'title' => 'Laporan Transaksi',
            'active' => 'laporan_transaksi',
        ];
        return view('laporan/Transaksi', $data);
    }
    
    public function ajaxLaporanTransaksi()
    {
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $jenis_transaksi = $this->request->getPost('jenis_transaksi');
        
        if($tgl_awal == null || $tgl_akhir == null){
            $tgl_awal = 0;
            $tgl_akhir = 0;
        }

        if($jenis_transaksi == ''){
            $builder = $this->transaksiModel->getTransaksi()->where('tanggal_transaksi >=', $tgl_awal)->where('tanggal_transaksi <=', $tgl_akhir);
        }else{
            $builder = $this->transaksiModel->getTransaksi()->where('tanggal_transaksi >=', $tgl_awal)->where('tanggal_transaksi <=', $tgl_akhir)->where('tipe_transaksi', $jenis_transaksi);
        }


        return DataTable::of($builder)
            ->add('tipe_transaksi', function($row){
                if($row->tipe_transaksi == 0){
                    return '<span class="badge badge-success">Masuk</span>';
                }else{
                    return '<span class="badge badge-danger">Keluar</span>';
                }
                return $row->status_inventaris;
            })
            ->add('detail_transaksi', function($row){
                $detailTransaksi = $this->detailTransaksiModel->getTransByTransId($row->id_transaksi)->findAll();
                $html = '';
                // - namaa barang - tipe barang - qty - @ satuan
                foreach($detailTransaksi as $dt){
                    $html .= '<p class="detail_trans">- '.$dt['nama_barang'].' - '.$dt['nama_tipe_barang'].' - '.$dt['qty'].' @ '.$dt['nama_satuan'].'</p><br>';
                }
                return $html;
            })
            ->toJson(true);
        
    }
}



?>