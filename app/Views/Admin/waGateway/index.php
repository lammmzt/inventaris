<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">Data Wa Gateway</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addwa_gateway"
                            type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tablewa_gateway">
                        <thead>
                            <tr>
                                <th class="table-plus">Nama</th>
                                <th class="">Token</th>
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

<!-- modal addwa_gateway -->
<div class="modal fade" id="addwa_gateway" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tambah wa_gateway
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_wa_gateway">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_perangkat_wa_gateway" class="col-sm-4 col-form-label">Nama<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="nama_perangkat_wa_gateway"
                                name="nama_perangkat_wa_gateway" placeholder="Masukan nama perangkat">
                            <div class="form-control-feedback " id="errornama_perangkat_wa_gateway"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="token_wa_gateway" class="col-sm-4 col-form-label">Nama<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="token_wa_gateway"
                                name="token_wa_gateway" placeholder="Masukan token">
                            <div class="form-control-feedback " id="errortoken_wa_gateway"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_tambah_wa_gateway">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editwa_gateway" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edit wa_gateway
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_edit_wa_gateway">
                <div class="modal-body">
                    <input type="hidden" id="editid_wa_gateway" name="id_wa_gateway">
                    <div class="form-group row">
                        <label for="editnama_perangkat_wa_gateway" class="col-sm-4 col-form-label">Nama Perangkat<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editnama_perangkat_wa_gateway"
                                name="nama_perangkat_wa_gateway">
                            <div class="form-control-feedback " id="erroreditnama_perangkat_wa_gateway"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edittoken_wa_gateway" class="col-sm-4 col-form-label">Token<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="edittoken_wa_gateway"
                                name="token_wa_gateway">
                            <div class="form-control-feedback " id="erroredittoken_wa_gateway"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_edit_wa_gateway">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ======================================== END wa_gateway ======================================== -->


<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// dataTables wa_gateway
function dataTableswa_gateway() {
    $(document).ready(function() {
        $('#tablewa_gateway').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/waGateway/DataTables') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_perangkat_wa_gateway'
                },
                {
                    data: 'token_wa_gateway'
                },
                {
                    data: 'status_wa_gateway',
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
    dataTableswa_gateway();
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

// ======================================== wa_gateway ========================================

// DATA
const wa_gateway = [
    'nama_perangkat_wa_gateway',
    'id_wa_gateway',
    'token_wa_gateway',
];


// tambah 
$(function() {
    $("#form_tambah_wa_gateway").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_tambah_wa_gateway").attr("disabled", "disabled");
            $("#btn_tambah_wa_gateway").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/waGateway/save') ?>',
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
                        $("#form_tambah_wa_gateway")[0].reset();
                        $("#addwa_gateway").modal('hide');
                        $('#tablewa_gateway').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        wa_gateway.forEach(function(item) {
                            $("#" + item).removeClass('form-control-danger');
                            $("#" + item).removeClass('form-control-success');
                            $("#error" + item).html('');
                            $("#error" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_tambah_wa_gateway").removeAttr("disabled");
                    $("#btn_tambah_wa_gateway").html("Tambah");
                }
            });
        }
    });
});

// edit wa_gateway
$(document).on('click', '.edit_wa_gateway', function() {
    const id = $(this).attr('id');
    $.ajax({
        url: '<?= base_url('Admin/waGateway/edit') ?>',
        method: 'post',
        data: {
            id_wa_gateway: id
        },
        dataType: 'json',
        success: function(response) {
            $('#editwa_gateway').modal('show');
            $.each(response.data, function(key, value) {
                $('#edit' + key).val(value);
            });

        }
    });
});

// update wa_gateway
$(function() {
    $("#form_edit_wa_gateway").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_edit_wa_gateway").attr("disabled", "disabled");
            $("#btn_edit_wa_gateway").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/waGateway/update') ?>',
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
                        $("#form_edit_wa_gateway")[0].reset();
                        $("#editwa_gateway").modal('hide');
                        $('#tablewa_gateway').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        wa_gateway.forEach(function(item) {
                            $("#edit" + item).removeClass('form-control-danger');
                            $("#edit" + item).removeClass('form-control-success');
                            $("#erroredit" + item).html('');
                            $("#erroredit" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_edit_wa_gateway").removeAttr("disabled");
                    $("#btn_edit_wa_gateway").html("Edit");
                }
            });
        }
    });
});

// delete wa_gateway
$(document).on('click', '.delete_wa_gateway', function() {
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
                    url: '<?= base_url('Admin/waGateway/delete') ?>',
                    method: 'post',
                    data: {
                        id_wa_gateway: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#tablewa_gateway').DataTable().ajax.reload();
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
$(document).on('click', '.change_status_wa_gateway', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/waGateway/updateStatus') ?>',
        method: 'post',
        data: {
            id_wa_gateway: id
        },
        dataType: 'json',
        success: function(response) {
            // wa_gateway').DataTable().ajax.reload();
            getSwall(response.status, response.data);
        }
    });
});

// testConnection
$(document).on('click', '.test_connection_waGateway', function() {
    const id = $(this).attr('id');
    $.ajax({
        url: '<?= base_url('Admin/waGateway/testConnection') ?>',
        method: 'post',
        data: {
            token_wa_gateway: id
        },
        dataType: 'json',
        success: function(response) {
            getSwall(response.status, response.data);
        }
    });
});
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>