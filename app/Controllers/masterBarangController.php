<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\usersModel;
use Ramsey\Uuid\Uuid;

class masterBarangController extends BaseController
{
    protected $masterBarangModel;

    public function __construct()
    {
        $this->masterBarangModel = new masterBarangModel();
    }
    public function index()
    {
        $data = [
            'main_menu' => 'Master Data',
            'title' => 'Data Barang',
            'active' => 'Barang',
        ];
        return view('Admin/Barang/index', $data);
    }

    public function ajaxDataTables()
    {
        $builder = $this->masterBarangModel->getBarang();
        // dd($builder);
        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item view_barang" id="' . $row->id_barang . '"><i class="dw dw-eye"></i> View</a>
                            <button class="dropdown-item edit_barang" id="' . $row->id_barang . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item delete_barang" id="' . $row->id_barang . '"><i class="dw dw-delete-3"></i> Delete</button>
                        </div>
                </div>
                ';
            }, 'last')
            ->toJson(true);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required|is_unique[master_barang.nama_barang]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'harga' => [
                'label' => 'Harga',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'stok' => [
                'label' => 'Stok',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'error' => [
                    'nama_barang' => $validation->getError('nama_barang'),
                    'harga' => $validation->getError('harga'),
                    'stok' => $validation->getError('stok'),
                ]
            ]);
        }

        $this->masterBarangModel->save([
            'id_barang' => Uuid::uuid4()->toString(),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok'),
        ]);

        return $this->response->setJSON([
            'success' => 'Data berhasil disimpan'
        ]);
    }

}

?>