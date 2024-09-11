<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">Data Ruangan</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addruangan" type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tableruangan">
                        <thead>
                            <tr>
                                <th class="table-plus">Nama Ruangan</th>
                                <th class="">Status Ruangan</th>
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

<!-- modal addruangan -->
<div class="modal fade" id="addruangan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tambah ruangan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_ruangan">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_ruangan" class="col-sm-4 col-form-label">Nama ruangan<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="nama_ruangan" name="nama_ruangan"
                                placeholder="Masukan nama ruangan">
                            <div class="form-control-feedback " id="errornama_ruangan"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_tambah_ruangan">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editruangan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edit ruangan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_edit_ruangan">
                <div class="modal-body">
                    <input type="hidden" id="editid_ruangan" name="id_ruangan">
                    <div class="form-group row">
                        <label for="editnama_ruangan" class="col-sm-4 col-form-label">Nama ruangan<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editnama_ruangan" name="nama_ruangan">
                            <div class="form-control-feedback " id="erroreditnama_ruangan"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_edit_ruangan">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ======================================== END ruangan ======================================== -->

<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// dataTables ruangan
function dataTablesruangan() {
    $(document).ready(function() {
        $('#tableruangan').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/Ruangan/DataTables') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_ruangan'
                },
                {
                    data: 'status_ruangan',
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
    dataTablesruangan();
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

// ======================================== ruangan ========================================

// DATA
const ruangan = [
    'nama_ruangan',
    'id_ruangan'
];


// tambah 
$(function() {
    $("#form_tambah_ruangan").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_tambah_ruangan").attr("disabled", "disabled");
            $("#btn_tambah_ruangan").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/Ruangan/save') ?>',
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
                        $("#form_tambah_ruangan")[0].reset();
                        $("#addruangan").modal('hide');
                        $('#tableruangan').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        ruangan.forEach(function(item) {
                            $("#" + item).removeClass('form-control-danger');
                            $("#" + item).removeClass('form-control-success');
                            $("#error" + item).html('');
                            $("#error" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_tambah_ruangan").removeAttr("disabled");
                    $("#btn_tambah_ruangan").html("Tambah");
                }
            });
        }
    });
});

// edit ruangan
$(document).on('click', '.edit_ruangan', function() {
    const id = $(this).attr('id');
    $.ajax({
        url: '<?= base_url('Admin/Ruangan/edit') ?>',
        method: 'post',
        data: {
            id_ruangan: id
        },
        dataType: 'json',
        success: function(response) {
            $('#editruangan').modal('show');
            $.each(response.data, function(key, value) {
                $('#edit' + key).val(value);
            });

        }
    });
});

// update ruangan
$(function() {
    $("#form_edit_ruangan").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_edit_ruangan").attr("disabled", "disabled");
            $("#btn_edit_ruangan").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/Ruangan/update') ?>',
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
                        $("#form_edit_ruangan")[0].reset();
                        $("#editruangan").modal('hide');
                        $('#tableruangan').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        ruangan.forEach(function(item) {
                            $("#edit" + item).removeClass('form-control-danger');
                            $("#edit" + item).removeClass('form-control-success');
                            $("#erroredit" + item).html('');
                            $("#erroredit" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_edit_ruangan").removeAttr("disabled");
                    $("#btn_edit_ruangan").html("Edit");
                }
            });
        }
    });
});

// delete ruangan
$(document).on('click', '.delete_ruangan', function() {
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
                    url: '<?= base_url('Admin/Ruangan/delete') ?>',
                    method: 'post',
                    data: {
                        id_ruangan: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#tableruangan').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                    }
                });
            }
        });
});




// change status
$(document).on('click', '.change_status_ruangan', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/Ruangan/updateStatus') ?>',
        method: 'post',
        data: {
            id_ruangan: id
        },
        dataType: 'json',
        success: function(response) {
            // ruangan').DataTable().ajax.reload();
            getSwall(response.status, response.data);
        }
    });
});
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>