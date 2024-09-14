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
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addinventaris"
                            type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap checkbox-datatable table nowrap"
                        id="tableInventaris">
                        <thead>
                            <tr>
                                <th>
                                    <!-- <div class="dt-checkbox">
                                        <input type="checkbox" name="select_all" value="1" id="example-select-all" />
                                        <span class="dt-checkbox-label"></span>
                                    </div> -->
                                </th>
                                <th class="table-plus">Nama Barang</th>
                                <th class="table-plus">Merek Inventaris</th>
                                <th class="table-plus">QTY</th>
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
            <!-- <form id="form_tambah_inventaris"> -->
            <form action="<?= base_url('Admin/Inventaris/save') ?>" method="post">
                <!-- <form action="<?= base_url('Admin/inventaris/save') ?>" method="post"> -->
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tipe_barang_id" class="col-sm-4 col-form-label">Nama Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="tipe_barang_id"
                                id="tipe_barang_id" style="width: 100%; height: 38px;">

                            </select>
                            <div class="form-control-feedback " id="errortipe_barang_id"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_inventaris" class="col-sm-4 col-form-label">Nama Inventaris<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="nama_inventaris" name="nama_inventaris"
                                placeholder="Masukan Merek inventaris">
                            <div class="form-control-feedback " id="errornama_inventaris"></div>
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
                        <label for="qty_inventaris" class="col-sm-4 col-form-label">QTY inventaris<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control required" id="qty_inventaris" name="qty_inventaris"
                                placeholder="Masukan Merek inventaris" min="0" value="0">
                            <div class="form-control-feedback " id="errorqty_inventaris"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ruangan_id" class="col-sm-4 col-form-label">Ruangan<span
                                class="rq">*</span></label></label>
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
                            inventaris</label></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="spek_inventaris" name="spek_inventaris"
                                style="height: 100px;" placeholder="Masukan Spesifikasi inventaris"></textarea>
                            <div class="form-control-feedback " id="errorspek_inventaris"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="perolehan_inventaris" class="col-sm-4 col-form-label">Perolehan
                            inventaris</label></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="perolehan_inventaris"
                                name="perolehan_inventaris" placeholder="Masukan Perolehan inventaris">
                            <div class="form-control-feedback " id="errorperolehan_inventaris"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sumber_inventaris" class="col-sm-4 col-form-label">Sumber inventaris</label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="sumber_inventaris" name="sumber_inventaris"
                                placeholder="Masukan Sumber inventaris">
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
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control required" name="tipe_barang_id"
                                id="edittipe_barang_id" style="width: 100%; height: 38px;">

                            </select>
                            <div class="form-control-feedback " id="erroreditipe_barang_id"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editnama_inventaris" class="col-sm-4 col-form-label">Merek inventaris<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editnama_inventaris"
                                name="nama_inventaris">
                            <div class="form-control-feedback " id="erroreditnama_inventaris"></div>
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
                        <label for="editqty_inventaris" class="col-sm-4 col-form-label">QTY inventaris<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control required" id="editqty_inventaris"
                                name="qty_inventaris" placeholder="Masukan Merek inventaris" min="0" value="0">
                            <div class="form-control-feedback " id="erroreditqty_inventaris"></div>
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
                    data: 'nama_barang'
                },
                {
                    data: 'nama_inventaris'
                },
                {
                    data: 'qty_inventaris',
                    class: 'text-center'
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

// ketika modal tambah inventaris muncul
$('#addinventaris').on('shown.bs.modal', function() {
    getTipeBarang();
    getSatuan();
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
    'satuan_id',
    'ruangan_id',
    'qty_inventaris',
    'spek_inventaris',
    'status_inventaris',
    'perolehan_inventaris',
    'sumber_inventaris',
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

// edit inventaris
$(document).on('click', '.edit_inventaris', function() {
    const id = $(this).attr('id');
    $.ajax({
        url: '<?= base_url('Admin/inventaris/edit') ?>',
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
                url: '<?= base_url('Admin/inventaris/update') ?>',
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
                        $("#form_edit_inventaris")[0].reset();
                        $("#editinventaris").modal('hide');
                        $('#tableInventaris').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        inventaris.forEach(function(item) {
                            $("#edit" + item).removeClass('form-control-danger');
                            $("#edit" + item).removeClass('form-control-success');
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
                    url: '<?= base_url('Admin/inventaris/delete') ?>',
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




// change status
$(document).on('click', '.change_status_inventaris', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/inventaris/changeStatus') ?>',
        method: 'post',
        data: {
            id_inventaris: id
        },
        dataType: 'json',
        success: function(response) {
            // inventaris').DataTable().ajax.reload();
            getSwall(response.status, response.data);
        }
    });
});
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>