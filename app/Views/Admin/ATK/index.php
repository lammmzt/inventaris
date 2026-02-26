<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">Data ATK</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#importDataATK"
                            type="button">
                            <i class="icon-copy fa fa-upload" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addatk" type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tableatk">
                        <thead>
                            <tr>
                                <th class="table-plus">Foto Barang</th>
                                <th class="table-plus">Nama Barang</th>
                                <th class="table-plus">Barcode ATK</th>
                                <th class="table-plus">Merek ATK</th>
                                <th class="table-plus">QTY</th>
                                <th class="">Status ATK</th>
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

<!-- modal addatk -->
<div class="modal fade" id="addatk" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tambah ATK
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_atk" enctype="multipart/form-data">
                <!-- <form action="<?= base_url('Admin/ATK/save') ?>" method="post"> -->
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="id_tipe_barang" class="col-sm-4 col-form-label">Nama Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="id_tipe_barang"
                                id="id_tipe_barang" style="width: 100%; height: 38px;">

                            </select>
                            <div class="form-control-feedback " id="errorid_tipe_barang"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="barcode_atk" class="col-sm-4 col-form-label">Barcode ATK<span
                                class=""></span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="barcode_atk" name="barcode_atk"
                                placeholder="Scan Barcode ATK">
                            <div class="form-control-feedback " id="errorbarcode_atk"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merek_atk" class="col-sm-4 col-form-label">Merek ATK<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="merek_atk" name="merek_atk"
                                placeholder="Masukan Merek ATK">
                            <div class="form-control-feedback " id="errormerek_atk"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merek_atk" class="col-sm-4 col-form-label">Foto ATK<span
                                class=""></span></label></label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="foto_atk" name="foto_atk" accept="image/*">
                            <div class="form-control-feedback " id="errormerek_atk"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty_atk" class="col-sm-4 col-form-label">QTY ATK<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control required" id="qty_atk" name="qty_atk"
                                placeholder="Masukan Merek ATK" min="0" value="0">
                            <div class="form-control-feedback " id="errorqty_atk"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="button" class="btn btn-primary" id="btn_tambah_atk">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editatk" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edit ATK
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_edit_atk" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="editid_atk" name="id_atk">
                    <div class="form-group row">
                        <label for="editid_tipe_barang" class="col-sm-4 col-form-label">Nama Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="id_tipe_barang"
                                id="editid_tipe_barang" style="width: 100%; height: 38px;">

                            </select>
                            <div class="form-control-feedback " id="erroreditid_tipe_barang"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editbarcode_atk" class="col-sm-4 col-form-label">Barcode ATK<span
                                class=""></span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="editbarcode_atk" name="barcode_atk"
                                placeholder="Scan Barcode ATK">
                            <div class="form-control-feedback " id="erroreditbarcode_atk"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editbarcode_atk" class="col-sm-4 col-form-label">Merek ATK<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editmerek_atk" name="merek_atk">
                            <div class="form-control-feedback " id="erroreditmerek_atk"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merek_atk" class="col-sm-4 col-form-label">Foto ATK<span
                                class=""></span></label></label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="foto_atk" name="foto_atk" accept="image/*">
                            <div class="form-control-feedback " id="errormerek_atk"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editqty_atk" class="col-sm-4 col-form-label">QTY ATK<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control required" id="editqty_atk" name="qty_atk"
                                placeholder="Masukan Merek ATK" min="0" value="0">
                            <div class="form-control-feedback " id="erroreditqty_atk"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" id="btn_edit_atk">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal import data Inventaris -->
<div class="modal fade" id="importDataATK" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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

                            <small class="text-danger">* File Excel harus sesuai dengan template yang telah
                                disediakan
                                <a href="<?= base_url('Assets/Files/template_import_atk.xlsx') ?>"
                                    target="_blank">Download Template</a>
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
                                    <th scope="col" class="text-center ">Kode Transaksi</th>
                                    <th scope="col" class="text-center">Pesan</th>
                                </thead>
                                <tbody id="detailData">
                                    <!-- <tr>
                                        <td colspan="2" class="text-center">Belum ada data</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_import_data">
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ======================================== END atk ======================================== -->

<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<script text="text/javascript">
// dataTables atk
function dataTablesatk() {
    $(document).ready(function() {
        $('#tableatk').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/ATK/DataTables') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'foto_atk',
                    class: 'text-center'
                },
                {
                    data: 'nama_barang'
                },
                {
                    data: 'barcode_atk',
                    class: 'text-center'
                },
                {
                    data: 'merek_atk'
                },
                {
                    data: 'qty_atk',
                    class: 'text-center'
                },
                {
                    data: 'status_atk',
                    class: 'text-center'
                },
                {
                    data: 'action',
                    class: 'datatable-nosort text-center'
                },

            ],
            drawCallback: function() {
                JsBarcode(".barcode").init();
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
            jenis_barang: '0'
        },
        success: function(response) {
            var html = '';
            html += '<option value="">Pilih Barang</option>';
            $.each(response.data, function(key, value) {
                html += '<option value="' + value.id_tipe_barang + '">' + value.nama_barang +
                    ' - ' + value.nama_tipe_barang +
                    '</option>';
            });
            $('#id_tipe_barang').html(html);
        }
    });
};



$(document).ready(function() {
    dataTablesatk();
});

// ketika modal tambah atk muncul
$('#addatk').on('shown.bs.modal', function() {
    getTipeBarang();
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

// ======================================== atk ========================================

// DATA
const atk = [
    'merek_atk',
    'id_atk',
    'id_tipe_barang',
    'qty_atk'
];

// hapus error
atk.forEach(function(item) {
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

// tambah 
// ketika klik tombol simpan
$(document).on("click", "#btn_tambah_atk", function(e) {
    e.preventDefault();

    let form = $("#form_tambah_atk")[0];

    // cek validasi HTML5
    if (!form.checkValidity()) {
        form.reportValidity(); // tampilkan pesan validasi bawaan browser
        return;
    }

    // jika valid → jalan AJAX
    let formData = new FormData(form);

    if (!this.checkValidity()) {
        e.preventDefault();
        $(this).addClass('form-control-success');
    } else {
        $("#btn_tambah_atk").attr("disabled", "disabled");
        $("#btn_tambah_atk").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            url: '<?= base_url('Admin/ATK/save') ?>',
            method: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    // jika response.data bukan array
                    if (typeof response.data == 'object') {
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
                        getSwall(response.status, response.data);
                    }
                } else {
                    $("#form_tambah_atk")[0].reset();
                    $("#addatk").modal('hide');
                    $('#tableatk').DataTable().ajax.reload();
                    getSwall(response.status, response.data);
                    atk.forEach(function(item) {
                        $("#" + item).removeClass('form-control-danger');
                        $("#" + item).removeClass('form-control-success');
                        $("#error" + item).html('');
                        $("#error" + item).removeClass('has-danger');
                    });
                }
                $("#btn_tambah_atk").removeAttr("disabled");
                $("#btn_tambah_atk").html("Tambah");
            }
        });
    }
});

// fungsi get data edit barang
function getEditBarang($id_barang) {
    $.ajax({
        url: '<?= base_url('Admin/Barang/Detail/fetchTipeBarangByJenisBarang') ?>',
        method: 'post',
        dataType: 'json',
        data: {
            jenis_barang: '0'
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

            $('#editid_tipe_barang').html(html);
        }
    });
}

// edit atk
$(document).on('click', '.edit_atk', function() {
    const id = $(this).attr('id');
    $.ajax({
        url: '<?= base_url('Admin/ATK/edit') ?>',
        method: 'post',
        data: {
            id_atk: id
        },
        dataType: 'json',
        success: function(response) {
            $('#editatk').modal('show');
            $.each(response.data, function(key, value) {
                $('#edit' + key).val(value);
            });
            const old_id_tipe_barang = response.data.id_tipe_barang;
            getEditBarang(old_id_tipe_barang);
        }
    });
});

// update atk
// ketika klik tombol simpan
$(document).on("click", "#btn_edit_atk", function(e) {
    e.preventDefault();

    let form = $("#form_edit_atk")[0];

    // cek validasi HTML5
    if (!form.checkValidity()) {
        form.reportValidity(); // tampilkan pesan validasi bawaan browser
        return;
    }

    // jika valid → jalan AJAX
    let formData = new FormData(form);

    if (!this.checkValidity()) {
        e.preventDefault();
        $(this).addClass('form-control-success');
    } else {
        $("#btn_edit_atk").attr("disabled", "disabled");
        $("#btn_edit_atk").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            url: '<?= base_url('Admin/ATK/update') ?>',
            method: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                // alert(formData);
                if (response.error) {
                    if (typeof response.data == 'object') {
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
                        getSwall(response.status, response.data);
                    }
                } else {
                    $("#form_edit_atk")[0].reset();
                    $("#editatk").modal('hide');
                    $('#tableatk').DataTable().ajax.reload();
                    getSwall(response.status, response.data);
                    atk.forEach(function(item) {
                        $("#edit" + item).removeClass('form-control-danger');
                        $("#edit" + item).removeClass('form-control-success');
                        $("#erroredit" + item).html('');
                        $("#erroredit" + item).removeClass('has-danger');
                    });
                }
                $("#btn_edit_atk").removeAttr("disabled");
                $("#btn_edit_atk").html("Edit");
            }
        });
    }
});

// delete atk
$(document).on('click', '.delete_atk', function() {
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
                    url: '<?= base_url('Admin/ATK/delete') ?>',
                    method: 'post',
                    data: {
                        id_atk: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#tableatk').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                    },
                    error: function() {
                        //alert('data tidak dapat dihapus');
                        getSwall('error', 'Data tidak dapat dihapus');
                    },
                });
            }
        });
});

// change status
$(document).on('click', '.change_status_atk', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/ATK/changeStatus') ?>',
        method: 'post',
        data: {
            id_atk: id
        },
        dataType: 'json',
        success: function(response) {
            // atk').DataTable().ajax.reload();
            getSwall(response.status, response.data);
        }
    });
});

// when close modal import data
$('#importDataATK').on('hidden.bs.modal', function() {
    $("#form_import")[0].reset();
    $("#statusImport").hide();
    $("#detailImportData").hide();
    $('#tableImport').DataTable().destroy();
    $("#errorfile").html('');
    $("#errorfile").removeClass('has-danger');
});

$(function() {
    $("#form_import").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_import_data").attr("disabled", "disabled");
            $("#btn_import_data").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/ATK/importData') ?>',
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
                        $("#btn_import_data").removeAttr("disabled");
                        $("#btn_import_data").html("Import");
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
                                        data: 'id_atk'
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
                        $("#form_import")[0].reset();
                        $("#btn_import_data").removeAttr("disabled");
                        $("#btn_import_data").html("Import");
                        $('#tableatk').DataTable().ajax.reload();
                        $("#statusImport").show();
                        $("#detailImportData").show();
                        $('#tableatk').DataTable().ajax.reload();
                        // clear error
                        $("#errorfile").html('');
                        $("#errorfile").removeClass('has-danger');
                    }
                }
            });
        }
    });
});
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>