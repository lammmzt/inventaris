<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20 card-box">
                <h5 class="h4 text-blue mb-20">Data Transaksi</h5>
                <div class="tab">
                    <!-- 2 tab dengan lebar full width ditengah -->
                    <ul class="nav nav-tabs customtab nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#masuk" role="tab"
                                aria-selected="true">MASUK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#keluar" role="tab"
                                aria-selected="false">KELUAR</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="masuk" role="tabpanel">
                            <div class="pd-20">
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <!-- <h4 class="text-blue h4">Data ATK</h4> -->
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a href="<?= base_url('Admin/ATK/Transaksi/FORM_MASUK') ?>"
                                            class="btn btn-primary">
                                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="pb-20 table-responsive">
                                    <table class="table hover multiple-select-row nowrap" id="tabelTransaksiMasuk">
                                        <thead>
                                            <tr>
                                                <th class="table-plus">Nama User</th>
                                                <th class="table-plus">Tanggal</th>
                                                <th class="">Status</th>
                                                <th class="datatable-nosort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="keluar" role="tabpanel">
                            <div class="pd-20">
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <!-- <h4 class="text-blue h4">Data ATK</h4> -->
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addatk"
                                            type="button">
                                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="pb-20 table-responsive">
                                    <table class="table hover multiple-select-row nowrap" id="tabelTransaksiKeluar">
                                        <thead>
                                            <tr>
                                                <th class="table-plus">Nama User</th>
                                                <th class="table-plus">Tanggal</th>
                                                <th class="">Status</th>
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
            <form id="form_tambah_atk">
                <!-- <form action="<?= base_url('Admin/ATK/save') ?>" method="post"> -->
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tipe_barang_id" class="col-sm-4 col-form-label">Nama Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="tipe_barang_id"
                                id="tipe_barang_id" style="width: 100%; height: 38px;">
                                <div class="form-control-feedback " id="errortipe_barang_id"></div>
                            </select>
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
                        <label for="satuan_id" class="col-sm-4 col-form-label">Satuan<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="satuan_id" id="satuan_id"
                                style="width: 100%; height: 38px;">
                                <option value="">Pilih Satuan</option>
                            </select>
                            <div class="form-control-feedback " id="errorsatuan_id"></div>
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
                        <button type="submit" class="btn btn-primary" id="btn_tambah_atk">
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
            <form id="form_edit_atk">
                <div class="modal-body">
                    <input type="hidden" id="editid_atk" name="id_atk">
                    <div class="form-group row">
                        <label for="edittipe_barang_id" class="col-sm-4 col-form-label">Nama Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="tipe_barang_id"
                                id="edittipe_barang_id" style="width: 100%; height: 38px;">

                            </select>
                            <div class="form-control-feedback " id="erroreditipe_barang_id"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editmerek_atk" class="col-sm-4 col-form-label">Merek ATK<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editmerek_atk" name="merek_atk">
                            <div class="form-control-feedback " id="erroreditmerek_atk"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editsatuan_id" class="col-sm-4 col-form-label">Satuan<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="satuan_id" id="editsatuan_id"
                                style="width: 100%; height: 38px;">
                                <option value="">Pilih Satuan</option>
                            </select>
                            <div class="form-control-feedback " id="erroreditsatuan_id"></div>
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
                    <button type="submit" class="btn btn-primary" id="btn_edit_atk">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ======================================== END atk ======================================== -->

<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// dataTables atk
function dataTablesTransMasuk() {
    $(document).ready(function() {
        $('#tabelTransaksiMasuk').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/ATK/Transaksi/DataTablesMasuk') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_user'
                },
                {
                    data: 'tanggal_transaksi'
                },
                {
                    data: 'status_transaksi',
                    class: 'text-center'
                },
                {
                    data: 'action',
                    class: 'datatable-nosort'
                },

            ],
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
        });
    });
}

// datatables transaksi keluar
function dataTablesTransKeluar() {
    $(document).ready(function() {
        $('#tabelTransaksiKeluar').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/ATK/Transaksi/DataTablesKeluar') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_user'
                },
                {
                    data: 'tanggal_transaksi'
                },
                {
                    data: 'status_transaksi',
                    class: 'text-center'
                },
                {
                    data: 'action',
                    class: 'datatable-nosort'
                },

            ],
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
            $('#tipe_barang_id').html(html);
        }
    });
};

// get data satuan
function getSatuan() {
    $.ajax({
        url: '<?= base_url('Admin/Satuan/fetchAll') ?>',
        method: 'post',
        dataType: 'json',
        success: function(response) {
            var html = '';
            html += '<option value="">Pilih Satuan</option>';
            $.each(response.data, function(key, value) {
                html += '<option value="' + value.id_satuan + '">' + value.nama_satuan +
                    '</option>';
            });
            $('#satuan_id').html(html);
        }
    });
};

$(document).ready(function() {
    dataTablesTransMasuk();
    dataTablesTransKeluar();
});

// ketika modal tambah atk muncul
$('#addatk').on('shown.bs.modal', function() {
    getTipeBarang();
    getSatuan();
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
    'tipe_barang_id',
    'satuan_id',
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
$(function() {
    $("#form_tambah_atk").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
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
                        $("#form_tambah_atk")[0].reset();
                        $("#addatk").modal('hide');
                        $('#tabelTransaksiMasuk').DataTable().ajax.reload();
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

            $('#edittipe_barang_id').html(html);
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
            const old_tipe_barang_id = response.data.tipe_barang_id;
            const old_satuan_id = response.data.satuan_id;
            // alert(old_id_tipe_barang);
            getEditBarang(old_tipe_barang_id);
            $.ajax({
                url: '<?= base_url('Admin/Satuan/fetchAll') ?>',
                method: 'post',
                dataType: 'json',
                success: function(response) {
                    var html = '';
                    $.each(response.data, function(key, value) {
                        if (value.id_satuan == old_satuan_id) {
                            // alert(value.id_satuan);
                            html += '<option value="' + value
                                .id_satuan +
                                '" selected>' + value.nama_satuan +
                                '</option>';
                        } else {
                            html += '<option value="' + value.id_satuan +
                                '">' + value.nama_satuan +
                                '</option>';
                        }
                    });
                    $('#editsatuan_id').html(html);
                }
            });
        }
    });
});

// update atk
$(function() {
    $("#form_edit_atk").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
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
                        // foeach error 
                        $.each(response.data, function(key, value) {
                            if (value != '') {
                                $("#edit" + key).addClass('form-control-danger');
                                $("#erroredit" + key).addClass('has-danger');
                                $("#erroredit" + key).html(value);
                            } else {
                                $("#edit" + key).removeClass('form-control-danger');
                                $("#edit" + key).addClass('form-control-success');
                                $("#erroredit" + key).html('');
                                $("#erroredit" + key).removeClass('has-danger');
                            }
                        });
                    } else {
                        $("#form_edit_atk")[0].reset();
                        $("#editatk").modal('hide');
                        $('#tabelTransaksiMasuk').DataTable().ajax.reload();
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
                        $('#tabelTransaksiMasuk').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                    }
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
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>