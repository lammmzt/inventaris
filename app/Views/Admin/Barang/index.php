<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">Data Barang</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addBarang" type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tableBarang">
                        <thead>
                            <tr>
                                <th class="table-plus">Kode Barang</th>
                                <th class="">Jenis Barang</th>
                                <th class="">Nama Barang</th>
                                <th class="">Status Barang</th>
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

<!-- modal addBarang -->
<div class="modal fade" id="addBarang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tambah Barang
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_barang">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="nama_barang" name="nama_barang"
                                placeholder="Masukan nama Barang">
                            <div class="form-control-feedback " id="errornama_barang"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_barang" class="col-sm-4 col-form-label">Jenis Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="form-control required" id="jenis_barang" name="jenis_barang">
                                <option value="">Pilih Jenis Barang</option>
                                <option value="1">Inventaris</option>
                                <option value="0">ATK</option>
                            </select>
                            <div class="form-control-feedback " id="errorjenis_barang"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_tambah_barang">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editbarang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edit barang
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_edit_barang">
                <div class="modal-body">
                    <input type="hidden" id="editid_barang" name="id_barang">
                    <div class="form-group row">
                        <label for="editnama_barang" class="col-sm-4 col-form-label">Nama Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editnama_barang" name="nama_barang">
                            <div class="form-control-feedback " id="erroreditnama_barang"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editjenis_barang" class="col-sm-4 col-form-label">Jenis Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="form-control required" id="editjenis_barang" name="jenis_barang">

                            </select>
                            <div class="form-control-feedback " id="erroreditjenis_barang"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_edit_barang">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ======================================== END barang ======================================== -->


<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// dataTables barang
function dataTablesBarang() {
    $(document).ready(function() {
        $('#tableBarang').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/Barang/DataTables') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'kode_barang',
                    class: 'table-plus'
                },
                {
                    data: 'jenis_barang',
                    class: 'text-center'
                },
                {
                    data: 'nama_barang'
                },
                {
                    data: 'status_barang',
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

$(document).ready(function() {
    dataTablesBarang();
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

// ======================================== barang ========================================

// DATA
const barang = [
    'nama_barang',
    'jenis_barang',
    'id_barang'
];


// tambah 
$(function() {
    $("#form_tambah_barang").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_tambah_barang").attr("disabled", "disabled");
            $("#btn_tambah_barang").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/Barang/save') ?>',
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
                        $("#form_tambah_barang")[0].reset();
                        $("#addBarang").modal('hide');
                        $('#tableBarang').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        barang.forEach(function(item) {
                            $("#" + item).removeClass('form-control-danger');
                            $("#" + item).removeClass('form-control-success');
                            $("#error" + item).html('');
                            $("#error" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_tambah_barang").removeAttr("disabled");
                    $("#btn_tambah_barang").html("Tambah");
                }
            });
        }
    });
});

// edit barang
$(document).on('click', '.edit_barang', function() {
    const id = $(this).attr('id');
    $.ajax({
        url: '<?= base_url('Admin/Barang/edit') ?>',
        method: 'post',
        data: {
            id_barang: id
        },
        dataType: 'json',
        success: function(response) {
            $('#editbarang').modal('show');
            $.each(response.data, function(key, value) {
                $('#edit' + key).val(value);
            });
            // add select in edit
            $('#editjenis_barang').html(
                `<option value="">Pilih Jenis Barang</option>
                <option value="1" ${response.data.jenis_barang == 1 ? 'selected' : ''}>Inventaris</option>
                <option value="0" ${response.data.jenis_barang == 0 ? 'selected' : ''}>ATK</option>`
            );

        }
    });
});

// update barang
$(function() {
    $("#form_edit_barang").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_edit_barang").attr("disabled", "disabled");
            $("#btn_edit_barang").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/Barang/update') ?>',
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
                        $("#form_edit_barang")[0].reset();
                        $("#editbarang").modal('hide');
                        $('#tableBarang').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        barang.forEach(function(item) {
                            $("#edit" + item).removeClass('form-control-danger');
                            $("#edit" + item).removeClass('form-control-success');
                            $("#erroredit" + item).html('');
                            $("#erroredit" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_edit_barang").removeAttr("disabled");
                    $("#btn_edit_barang").html("Edit");
                }
            });
        }
    });
});

// delete barang
$(document).on('click', '.delete_barang', function() {
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
                    url: '<?= base_url('Admin/Barang/delete') ?>',
                    method: 'post',
                    data: {
                        id_barang: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#tableBarang').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                    }
                });
            }
        });
});

// view barang
$(document).on('click', '.view_barang', function() {
    const id = $(this).attr('id');
    // alert(id);
    window.location.href = '<?= base_url('Admin/Barang/Detail/') ?>' + id;
});


// change status
$(document).on('click', '.change_status_barang', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/Barang/updateStatus') ?>',
        method: 'post',
        data: {
            id_barang: id
        },
        dataType: 'json',
        success: function(response) {
            // Barang').DataTable().ajax.reload();
            getSwall(response.status, response.data);
        }
    });
});
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>