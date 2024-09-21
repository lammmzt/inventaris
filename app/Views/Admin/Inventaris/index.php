<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">Data Inventaris</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#importDataInventaris"
                            type="button">
                            <i class="icon-copy fa fa-upload" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addinventaris"
                            type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <!-- cetak qr code -->
                <div class="row mb-4">
                    <!-- 2 button import and cetak qr code -->
                    <div class="col-sm-6">
                        <button class="btn btn-primary" type="button" id="print_qr_code">
                            <i class="icon-copy fa fa-print" aria-hidden="true"></i> Cetak QR Code
                        </button>
                    </div>
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap checkbox-datatable table nowrap"
                        id="tableInventaris">
                        <thead>
                            <tr>
                                <th class="datatable-nosort">
                                    <div class="dt-checkbox">
                                        <input type="checkbox" name="select_all" value="1" id="select_all_data" />
                                        <span class="dt-checkbox-label"></span>
                                    </div>
                                </th>
                                <th class="table-plus">Kode Inventaris</th>
                                <th class="table-plus">Nama Inventaris</th>
                                <th class="table-plus">Ruangan</th>
                                <th class="">Status inventaris</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal addinventaris -->
<div class="modal fade" id="addinventaris" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tambah Inventaris
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_inventaris">
                <!-- <form action="<?= base_url('Admin/inventaris/save') ?>" method="post"> -->
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tipe_barang_id" class="col-sm-4 col-form-label">Nama Barang<span
                                class="rq">*</span></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="tipe_barang_id"
                                id="tipe_barang_id" style="width: 100%; height: 38px;">

                            </select>
                            <div class="form-control-feedback " id="errortipe_barang_id"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_inventaris" class="col-sm-4 col-form-label">Nama Inventaris<span
                                class="rq">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="nama_inventaris" name="nama_inventaris"
                                placeholder="Masukan Nama inventaris">
                            <div class="form-control-feedback " id="errornama_inventaris"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty_inventaris" class="col-sm-4 col-form-label">QTY inventaris<span
                                class="rq">*</span></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control required" id="qty_inventaris" name="qty_inventaris"
                                placeholder="Masukan Nama inventaris" min="1" value="1" readonly>
                            <div class="form-control-feedback " id="errorqty_inventaris"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ruangan_id" class="col-sm-4 col-form-label">Ruangan<span class="rq">*</span></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="ruangan_id" id="ruangan_id"
                                style="width: 100%; height: 38px;">
                                <option value="">Pilih Ruangan</option>
                            </select>
                            <div class="form-control-feedback " id="errorruangan_id"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="spek_inventaris" class="col-sm-4 col-form-label">Spesifikasi
                            Inventaris<span class="rq">*</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="spek_inventaris" name="spek_inventaris"
                                style="height: 100px;" placeholder="Masukan Spesifikasi Inventaris"></textarea>
                            <div class="form-control-feedback " id="errorspek_inventaris"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="perolehan_inventaris" class="col-sm-4 col-form-label">Perolehan
                            Inventaris<span class="rq">*</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="perolehan_inventaris"
                                name="perolehan_inventaris" placeholder="Masukan Perolehan Inventaris">
                            <div class="form-control-feedback " id="errorperolehan_inventaris"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sumber_inventaris" class="col-sm-4 col-form-label">Sumber
                            Inventaris<span class="rq">*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="sumber_inventaris" name="sumber_inventaris"
                                placeholder="Masukan Sumber Inventaris">
                            <div class="form-control-feedback " id="errorsumber_inventaris"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary" id="btn_tambah_inventaris">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editinventaris" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edit inventaris
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_edit_inventaris">
                <div class="modal-body">
                    <input type="hidden" id="editid_inventaris" name="id_inventaris">
                    <div class="form-group row">
                        <label for="edittipe_barang_id" class="col-sm-4 col-form-label">Nama Barang<span
                                class="rq">*</span></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="tipe_barang_id"
                                id="edittipe_barang_id" style="width: 100%; height: 38px;">

                            </select>
                            <div class="form-control-feedback " id="erroreditipe_barang_id"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editnama_inventaris" class="col-sm-4 col-form-label">Nama inventaris<span
                                class="rq">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editnama_inventaris"
                                name="nama_inventaris">
                            <div class="form-control-feedback " id="erroreditnama_inventaris"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="editqty_inventaris" class="col-sm-4 col-form-label">QTY inventaris<span
                                class="rq">*</span></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control required" id="editqty_inventaris"
                                name="qty_inventaris" placeholder="Masukan Nama inventaris" min="0" readonly>
                            <div class="form-control-feedback " id="erroreditqty_inventaris"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editruangan_id" class="col-sm-4 col-form-label">Ruangan<span
                                class="rq">*</span></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="ruangan_id" id="editruangan_id"
                                style="width: 100%; height: 38px;">
                                <option value="">Pilih Ruangan</option>
                            </select>
                            <div class="form-control-feedback " id="erroreditruangan_id"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editspek_inventaris" class="col-sm-4 col-form-label">Spesifikasi
                            Inventaris<span class="rq">*</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="editspek_inventaris" name="spek_inventaris"
                                style="height: 100px;" placeholder="Masukan Spesifikasi Inventaris"></textarea>
                            <div class="form-control-feedback " id="erroreditspek_inventaris"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editperolehan_inventaris" class="col-sm-4 col-form-label">Perolehan
                            Inventaris<span class="rq">*</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="editperolehan_inventaris"
                                name="perolehan_inventaris" placeholder="Masukan Perolehan Inventaris">
                            <div class="form-control-feedback " id="erroreditperolehan_inventaris"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editsumber_inventaris" class="col-sm-4 col-form-label">Sumber
                            Inventaris<span class="rq">*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editsumber_inventaris" name="sumber_inventaris"
                                placeholder="Masukan Sumber Inventaris">
                            <div class="form-control-feedback " id="erroreditsumber_inventaris"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editstatus_inventaris" class="col-sm-4 col-form-label">Status
                            Inventaris<span class="rq">*</label>
                        <div class="col-sm-8">
                            <select class="form-control required" name="status_inventaris" id="editstatus_inventaris"
                                style="width: 100%; height: 38px;">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_edit_inventaris">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal import data siswa -->
<div class="modal fade" id="importDataInventaris" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Import Data Inventaris
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_import">
                <!-- <form action="<?= base_url('Admin/Inventaris/Import') ?>" method="post" enctype="multipart/form-data"> -->
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="file" class="col-sm-4 col-form-label">File Template</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="file" name="file" required>
                            <div class="form-control-feedback mb-4" id="errorfile"></div>

                            <small class="text-danger">* File Excel harus sesuai dengan template yang telah disediakan
                                <a href="#" id="downloadTemplate">Download Template</a>
                            </small>
                        </div>
                    </div>

                    <!-- <div class="row mx-2">
                        <div class="col-sm-12">
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row mt-2 justify-content-center" id="statusImport" style="display: none;">
                        <div class="col-sm-4">
                            <p>Total Data : <span id="totalData">0</span></p>
                        </div>
                        <div class="col-sm-4">
                            <p>Sukses : <span id="totalSukses">0</span></p>
                        </div>
                        <div class="col-sm-4">
                            <p>Gagal : <span id="totalGagal">0</span></p>
                        </div>
                    </div>
                    <div class="row mx-2 mt-1" id="detailImportData" style="display: none;">
                        <!-- <p class="text-center">Detail Import</p>  -->
                        <div class="table-responsive pagging">
                            <table class="table table table-striped" id="tableImport">
                                <thead>
                                    <th scope="col" class="text-center datatable-nosort">#</th>
                                    <th scope="col" class="text-center">Kode Transaksi</th>
                                    <th scope="col" class="text-center">Pesan</th>
                                </thead>
                                <tbody id="detailData">
                                    <!-- <tr>
                                        <td colspan="2" class="text-center">Belum ada data</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 text-center mt-2">
                            <button class="btn btn-primary" type="button" id="print_qr_code_import">
                                <i class="icon-copy fa fa-print" aria-hidden="true"></i> Cetak QR Code
                            </button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_tambah_user">
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modalDetail -->
<div class="modal fade" id="editPelaporan" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tindak Lanjut Pelaporan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_pelaporan" enctype="multipart/form-data">
                <!-- <form action="<?= base_url('Admin/Inventaris/Pelaporan/save') ?>" method="post"
                    enctype="multipart/form-data"> -->
                <div class="modal-body">
                    <input type="hidden" name="inventaris_id" id="inventaris_id_pelaporan">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Kode Inventaris</label><input type="text" class="form-control"
                                    id="kode_inventaris" name="kode_inventaris" placeholder="Kode Inventaris" required
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nama Inventaris</label><input type="text" class="form-control"
                                    id="nama_inventaris_pelaporan" name="nama_inventaris" placeholder="Nama Barang"
                                    required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Ruangan</label><input type="text" class="form-control"
                                    id="nama_ruangan_pelaporan" name="nama_ruangan" placeholder="Kode Inventaris"
                                    required readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Status Inventaris</label>
                                <input type="text" class="form-control" id="status_inventaris_pelaporan"
                                    name="status_inventaris" placeholder="Nama Barang" required readonly>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Keterangan <span class="rq">*</span></label>
                                <textarea type="text" class="form-control required" id="ket_pengecekan"
                                    name="ket_pengecekan" style="height: 50px;"
                                    placeholder="Masukan keterangan pengecekan" required></textarea>
                                <div class="form-control-feedback " id="errorket_pengecekan"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Status Pengecekan <span class="rq">*</span></label>
                                <select class="form-control required" id="status_pengecekan" name="status_pengecekan"
                                    required>
                                    <option value="">Pilih Status Pengecekan</option>
                                    <option value="1">Baik</option>
                                    <option value="2">Rusak</option>
                                    <option value="3">Perbaikan</option>
                                    <option value="0">Hilang</option>
                                </select>
                                <div class="form-control-feedback" id="errorstatus_pengecekan"></div>
                            </div>
                        </div>
                    </div>
                    <!-- upload gambar -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="foto_pengecekan" class="col-sm-4 col-form-label">Upload Gambar</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="foto_pengecekan" name="foto_pengecekan"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-blue h4">Histori Pelaporan</h4>
                            <table class="table table-bordered table-hover" id="table_history_pengecekan">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Pelapor</th>
                                        <th class="text-center">Tanggal Pengecekan</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center" style="width: 100px;">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary" id="btn_tindak_lanjut_pelaporan">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ======================================== END inventaris ======================================== -->

<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// dataTables inventaris
function dataTablesinventaris() {
    $(document).ready(function() {
        $('#tableInventaris').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/Inventaris/DataTables') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],

            columns: [{
                    data: 'id_inventaris',

                },
                {
                    data: 'kode_inventaris'
                },
                {
                    data: 'nama_barang'
                },
                {
                    data: 'nama_ruangan'
                },
                {
                    data: 'status_inventaris',
                    class: 'text-center'
                },
                {
                    data: 'action',
                    class: 'datatable-nosort text-center'
                },

            ],
            "order": [
                [4, "desc"]
            ],

            drawCallback: function() {
                $('#select_all_data').prop('checked', false);
            },


            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],

        });
    });
}


// get data tipe barang
function getTipeBarang() {
    $.ajax({
        url: '<?= base_url('Admin/Barang/Detail/fetchTipeBarangByJenisBarang') ?>',
        method: 'post',
        dataType: 'json',
        data: {
            jenis_barang: '1'
        },
        success: function(response) {
            var html = '';
            html += '<option value="">Pilih Barang</option>';
            $.each(response.data, function(key, value) {
                html += '<option value="' + value.id_tipe_barang + '">' + value.nama_barang +
                    ' - ' + value.nama_tipe_barang +
                    '</option>';
            });
            $('#tipe_barang_id').html(html);
        }
    });
};

// get data ruangan
function getRuangan() {
    $.ajax({
        url: '<?= base_url('Admin/Ruangan/fetchAll') ?>',
        method: 'post',
        dataType: 'json',
        success: function(response) {
            var html = '';
            html += '<option value="">Pilih Ruangan</option>';
            $.each(response.data, function(key, value) {
                html += '<option value="' + value.id_ruangan + '">' + value.nama_ruangan +
                    '</option>';
            });
            $('#ruangan_id').html(html);
        }
    });
};

$(document).ready(function() {
    dataTablesinventaris();
});

// download format import template_import.xlsx
$('#downloadTemplate').on('click', function() {
    window.location.href = '<?= base_url('Assets/Files/template_import.xlsx') ?>';
});

// ketika modal tambah inventaris muncul
$('#addinventaris').on('shown.bs.modal', function() {
    getTipeBarang();
    getRuangan();
});

function getSwall(status, message) {
    swal({
        title: message,
        type: status == '200' ? 'success' : 'error',
        showCancelButton: false,
        showConfirmButton: true,
        timer: 1500

    })
}

// ======================================== inventaris ========================================

// DATA
const inventaris = [
    'nama_inventaris',
    'id_inventaris',
    'kode_inventaris',
    'tipe_barang_id',
    'ruangan_id',
    'qty_inventaris',
    'spek_inventaris',
    'status_inventaris',
    'perolehan_inventaris',
    'sumber_inventaris',
    'status_inventaris'
];

// hapus error
inventaris.forEach(function(item) {
    $("#" + item).on('change', function() {
        $("#" + item).removeClass('form-control-danger');
        $("#" + item).removeClass('form-control-success');
        $("#error" + item).html('');
        $("#error" + item).removeClass('has-danger');
    });
    $("#edit" + item).on('change', function() {
        $("#edit" + item).removeClass('form-control-danger');
        $("#edit" + item).removeClass('form-control-success');
        $("#erroredit" + item).html('');
        $("#erroredit" + item).removeClass('has-danger');
    });
});

// chekbox all
$('#select_all_data').on('click', function() {
    // alert('ok');
    if (this.checked) {
        $('.check_select_item').each(function() {
            this.checked = true;
        });
    } else {
        $('.check_select_item').each(function() {
            this.checked = false;
        });
    }
});

// tambah 
$(function() {
    $("#form_tambah_inventaris").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_tambah_inventaris").attr("disabled", "disabled");
            $("#btn_tambah_inventaris").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/Inventaris/save') ?>',
                method: 'post',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        // foeach error 
                        $.each(response.data, function(key, value) {
                            if (value != '') {
                                $("#" + key).addClass('form-control-danger');
                                $("#error" + key).addClass('has-danger');
                                $("#error" + key).html(value);
                            } else {
                                $("#" + key).removeClass('form-control-danger');
                                $("#" + key).addClass('form-control-success');
                                $("#error" + key).html('');
                                $("#error" + key).removeClass('has-danger');
                            }
                        });
                    } else {
                        $("#form_tambah_inventaris")[0].reset();
                        $("#addinventaris").modal('hide');
                        $('#tableInventaris').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        setTimeout(() => {
                            pritnQrCode(response.qr_code);
                        }, 1500);
                        inventaris.forEach(function(item) {
                            $("#" + item).removeClass('form-control-danger');
                            $("#" + item).removeClass('form-control-success');
                            $("#error" + item).html('');
                            $("#error" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_tambah_inventaris").removeAttr("disabled");
                    $("#btn_tambah_inventaris").html("Tambah");
                }
            });
        }
    });
});

// fungsi get data edit barang
function getEditBarang($id_barang) {
    $.ajax({
        url: '<?= base_url('Admin/Barang/Detail/fetchTipeBarangByJenisBarang') ?>',
        method: 'post',
        dataType: 'json',
        data: {
            jenis_barang: '1'
        },
        success: function(response) {
            var html = '';
            // alert(old_id_tipe_barang);
            $.each(response.data, function(key, value) {
                if (value.id_tipe_barang == $id_barang) {
                    // alert(value.id_tipe_barang);
                    html += '<option value="' + value.id_tipe_barang +
                        '" selected>' +
                        value.nama_barang + ' - ' + value
                        .nama_tipe_barang + '</option>';
                } else {
                    html += '<option value="' + value.id_tipe_barang +
                        '">' +
                        value.nama_barang + ' - ' + value
                        .nama_tipe_barang +
                        '</option>';
                }
            });

            $('#edittipe_barang_id').html(html);
        }
    });
}

// fungsi get data edit ruangan
function getEditRuangan($id_ruangan) {
    $.ajax({
        url: '<?= base_url('Admin/Ruangan/fetchAll') ?>',
        method: 'post',
        dataType: 'json',
        success: function(response) {
            var html = '';
            $.each(response.data, function(key, value) {
                if (value.id_ruangan == $id_ruangan) {
                    html += '<option value="' + value.id_ruangan +
                        '" selected>' +
                        value.nama_ruangan + '</option>';
                } else {
                    html += '<option value="' + value.id_ruangan +
                        '">' +
                        value.nama_ruangan + '</option>';
                }
            });
            $('#editruangan_id').html(html);
        }
    });
}

// edit inventaris
$(document).on('click', '.edit_inventaris', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/Inventaris/edit') ?>',
        method: 'post',
        data: {
            id_inventaris: id
        },
        dataType: 'json',
        success: function(response) {
            $('#editinventaris').modal('show');
            $.each(response.data, function(key, value) {
                $('#edit' + key).val(value);
            });
            const old_tipe_barang_id = response.data.tipe_barang_id;
            // alert(old_tipe_barang_id);
            getEditBarang(old_tipe_barang_id);
            const old_ruangan_id = response.data.ruangan_id;
            getEditRuangan(old_ruangan_id);

            // status inventaris
            var html = '';
            html += '<option value="1" ' + (response.data.status_inventaris == 1 ? 'selected' :
                    '') +
                '>Baik</option>';
            html += '<option value="2" ' + (response.data.status_inventaris == 2 ? 'selected' :
                    '') +
                '>Rusak</option>';
            html += '<option value="3" ' + (response.data.status_inventaris == 3 ? 'selected' :
                    '') +
                '>Perbaikan</option>';
            html += '<option value="0" ' + (response.data.status_inventaris == 0 ? 'selected' :
                    '') +
                '>Hilang</option>';
            $('#editstatus_inventaris').html(html);
        }
    });
});

// update inventaris
$(function() {
    $("#form_edit_inventaris").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_edit_inventaris").attr("disabled", "disabled");
            $("#btn_edit_inventaris").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/Inventaris/update') ?>',
                method: 'post',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    // alert(formData);
                    if (response.error) {
                        // foeach error 
                        $.each(response.data, function(key, value) {
                            if (value != '') {
                                $("#edit" + key).addClass(
                                    'form-control-danger');
                                $("#erroredit" + key).addClass('has-danger');
                                $("#erroredit" + key).html(value);
                            } else {
                                $("#edit" + key).removeClass(
                                    'form-control-danger');
                                $("#edit" + key).addClass(
                                    'form-control-success');
                                $("#erroredit" + key).html('');
                                $("#erroredit" + key).removeClass('has-danger');
                            }
                        });
                    } else {
                        $("#form_edit_inventaris")[0].reset();
                        $("#editinventaris").modal('hide');
                        $('#tableInventaris').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        inventaris.forEach(function(item) {
                            $("#edit" + item).removeClass(
                                'form-control-danger');
                            $("#edit" + item).removeClass(
                                'form-control-success');
                            $("#erroredit" + item).html('');
                            $("#erroredit" + item).removeClass('has-danger');
                        });

                    }
                    $("#btn_edit_inventaris").removeAttr("disabled");
                    $("#btn_edit_inventaris").html("Edit");
                }
            });
        }
    });
});

// delete inventaris
$(document).on('click', '.delete_inventaris', function() {
    const id = $(this).attr('id');
    swal({
            title: "Apakah anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Ya, Hapus!",
            confirmButtonClass: "btn btn-success margin-5",
            cancelButtonText: "Batal",
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= base_url('Admin/Inventaris/delete') ?>',
                    method: 'post',
                    data: {
                        id_inventaris: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#tableInventaris').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                    }
                });
            }
        });
});

// when close modal import data
$('#importDataInventaris').on('hidden.bs.modal', function() {
    $("#form_import")[0].reset();
    $("#statusImport").hide();
    $("#detailImportData").hide();
    $('#tableImport').DataTable().destroy();
    $("#errorfile").html('');
    $("#errorfile").removeClass('has-danger');
    data_qr_code = [];
});


var data_qr_code = [];

// import data inventaris
$(function() {
    $("#form_import").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_tambah_user").attr("disabled", "disabled");
            $("#btn_tambah_user").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/Inventaris/Import') ?>',
                method: 'post',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        // foeach error 
                        $.each(response.data, function(key, value) {
                            if (value != '') {
                                $("#" + key).addClass('form-control-danger');
                                $("#error" + key).addClass('has-danger');
                                $("#error" + key).html(value);
                            } else {
                                $("#" + key).removeClass('form-control-danger');
                                $("#" + key).addClass('form-control-success');
                                $("#error" + key).html('');
                                $("#error" + key).removeClass('has-danger');
                            }
                        });
                        $("#btn_tambah_user").removeAttr("disabled");
                        $("#btn_tambah_user").html("Import");
                    } else {
                        // alert(response.data);
                        $("#totalData").html(response.total_data);
                        $("#totalSukses").html(response.data_success.length);
                        getSwall(response.status, response.data);

                        if (response.data_failed.length > 0) {
                            // datatables import
                            $('#tableImport').DataTable({
                                scrollCollapse: true,
                                autoWidth: false,
                                responsive: true,
                                columnDefs: [{
                                    targets: "datatable-nosort",
                                    orderable: false,
                                }],
                                "lengthMenu": [
                                    [5, 10, 25, 50, -1],
                                    [5, 10, 25, 50, "All"]
                                ],
                                dom: 'Bfrtip',
                                buttons: [
                                    'excel', 'pdf'
                                ],

                                data: response.data_failed,
                                columns: [{
                                        data: null,
                                        render: function(data, type, row,
                                            meta) {
                                            return meta.row + meta
                                                .settings
                                                ._iDisplayStart + 1;
                                        }
                                    },
                                    {
                                        data: 'kode_inventaris'
                                    },
                                    {
                                        data: 'message'
                                    }
                                ],
                                "language": {
                                    "info": "_START_-_END_ of _TOTAL_ entries",
                                    searchPlaceholder: "Search",
                                    paginate: {
                                        next: '<i class="ion-chevron-right"></i>',
                                        previous: '<i class="ion-chevron-left"></i>'
                                    }
                                },
                            });
                        }

                        $("#totalGagal").html(response.data_failed.length);
                        data_qr_code = response.data_success;
                        $("#form_import")[0].reset();
                        $("#btn_tambah_user").removeAttr("disabled");
                        $("#btn_tambah_user").html("Import");
                        $('#tableInventaris').DataTable().ajax.reload();
                        $("#statusImport").show();
                        $("#detailImportData").show();
                        $('#tableInventaris').DataTable().ajax.reload();
                        // clear error
                        $("#errorfile").html('');
                        $("#errorfile").removeClass('has-danger');
                    }
                }
            });
        }
    });
});

// cetak qr code import
function pritnQrCode(data) {
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "<?= base_url('Admin/Inventaris/pritnQrCode') ?>");
    form.setAttribute("target", "_blank");

    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "qr_code");
    hiddenField.setAttribute("value", data);
    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();

}

// when click button cetak qr code import
$('#print_qr_code_import').on('click', function() {
    if (data_qr_code == '') {
        swal({
            title: "Data QR Code Kosong",
            type: "warning",
            showCancelButton: false,
            showConfirmButton: true,
            timer: 1500
        });
    } else {
        pritnQrCode(data_qr_code);
    }
});

// when click button cetak qr code
$('#print_qr_code').on('click', function() {
    if ($('.check_select_item:checked').length == 0) {
        swal({
            title: "Pilih data yang akan dicetak",
            type: "warning",
            showCancelButton: false,
            showConfirmButton: true,
            timer: 1500
        });
    } else {
        var qr_code = [];
        $('.check_select_item:checked').each(function() {
            // get id form checkbox
            qr_code.push($(this).attr('id'));

        });
        // alert(qr_code);
        pritnQrCode(qr_code);
    }
});



// perbaiki inventaris
$(document).on('click', '.perbaiki_inventaris', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/Inventaris/fetchInventarisByKodeInventaris') ?>',
        method: 'post',
        data: {
            kode_inventaris: id
        },
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                $('#editPelaporan').modal('show');
                $('#inventaris_id_pelaporan').val(response.data.inventaris.id_inventaris);
                $('#kode_inventaris_pelaporan').val(response.data.inventaris.kode_inventaris);
                $('#nama_inventaris_pelaporan').val(response.data.inventaris.nama_inventaris);
                $('#nama_ruangan_pelaporan').val(response.data.inventaris.nama_ruangan);
                if (response.data.inventaris.status_inventaris == '1') {
                    $('#status_inventaris_pelaporan').val('Baik');
                } else if (response.data.inventaris.status_inventaris == '2') {
                    $('#status_inventaris').val('Rusak');
                } else if (response.data.inventaris.status_inventaris == '3') {
                    $('#status_inventaris_pelaporan').val('Dalam proses');
                } else {
                    $('#status_inventaris_pelaporan').val('Hilang');
                }
                if (response.data.pelaporan.length > 0) {
                    $('#table_history_pengecekan tbody').empty();
                    $.each(response.data.pelaporan, function(index, value) {
                        $('#table_history_pengecekan tbody').append(
                            '<tr>' +
                            '<td class="text-center">' + (index + 1) + '</td>' +
                            '<td>' + value.nama_user + '</td>' +
                            '<td class="text-center">' + value.created_at + '</td>' +
                            '<td>' + value.ket_pengecekan + '</td>' +
                            '<td class="text-center">' + (value.foto_pengecekan == '' ?
                                'Tidak ada foto' :
                                '<a href="<?= base_url('Assets/uploads/pengecekan/') ?>' +
                                value.foto_pengecekan +
                                '" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>' +
                                '</td>') +
                            '<td class="text-center">' + (value.status_pengecekan ==
                                '1' ?
                                '<span class="badge badge-success">Baik</span>' :
                                value.status_pengecekan == '2' ?
                                '<span class="badge badge-warning">Rusak</span>' :
                                value.status_pengecekan == '3' ?
                                '<span class="badge badge-info">Perbaikan</span>' :
                                '<span class="badge badge-danger">Hilang</span>') +
                            '</td>' +
                            '</tr>'
                        );
                    });
                } else {
                    $('#table_history_pengecekan tbody').empty();
                    $('#table_history_pengecekan tbody').append(
                        '<tr>' +
                        '<td colspan="6" class="text-center">Tidak ada data</td>' +
                        '</tr>'
                    );
                }

            } else {
                getSwall(response.status, response.data);
            }
        },
        error: function() {
            getSwall('error', 'Data tidak ditemukan');
        }
    });
});

// submit form
$("#form_tambah_pelaporan").submit(function(e) {
    e.preventDefault();
    $("#btn_tindak_lanjut_pelaporan").attr("disabled", "disabled");
    $("#btn_tindak_lanjut_pelaporan").html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    $.ajax({
        url: '<?= base_url('Admin/Inventaris/Pelaporan/save') ?>',
        method: 'post',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                getSwall(response.status, response.data);
                $('#form_tambah_pelaporan')[0].reset();
                $('#table_history_pengecekan tbody').empty();
                $('#table_history_pengecekan tbody').append(
                    '<tr>' +
                    '<td colspan="4" class="text-center">Tidak ada data</td>' +
                    '</tr>'
                );
                $('#tableInventaris').DataTable().ajax.reload();
                $('#editPelaporan').modal('hide');
                $("#btn_tindak_lanjut_pelaporan").removeAttr("disabled");
                $("#btn_tindak_lanjut_pelaporan").html('Simpan');
            } else {
                getSwall(response.status, response.data);
                $("#btn_tindak_lanjut_pelaporan").removeAttr("disabled");
                $("#btn_tindak_lanjut_pelaporan").html('Simpan');
            }
        }
    });
});
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>