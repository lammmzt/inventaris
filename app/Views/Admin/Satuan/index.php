<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">Data Satuan</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addsatuan" type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tablesatuan">
                        <thead>
                            <tr>
                                <th class="table-plus">Nama Satuan</th>
                                <th class="">Status Satuan</th>
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

<!-- modal addsatuan -->
<div class="modal fade" id="addsatuan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tambah satuan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_satuan">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_satuan" class="col-sm-4 col-form-label">Nama satuan<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="nama_satuan" name="nama_satuan"
                                placeholder="Masukan nama satuan">
                            <div class="form-control-feedback " id="errornama_satuan"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_tambah_satuan">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editsatuan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edit satuan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_edit_satuan">
                <div class="modal-body">
                    <input type="hidden" id="editid_satuan" name="id_satuan">
                    <div class="form-group row">
                        <label for="editnama_satuan" class="col-sm-4 col-form-label">Nama satuan<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editnama_satuan" name="nama_satuan">
                            <div class="form-control-feedback " id="erroreditnama_satuan"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_edit_satuan">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ======================================== END satuan ======================================== -->


<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// dataTables satuan
function dataTablessatuan() {
    $(document).ready(function() {
        $('#tablesatuan').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/Satuan/DataTables') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_satuan'
                },
                {
                    data: 'status_satuan',
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
    dataTablessatuan();
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

// ======================================== satuan ========================================

// DATA
const satuan = [
    'nama_satuan',
    'id_satuan'
];


// tambah 
$(function() {
    $("#form_tambah_satuan").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_tambah_satuan").attr("disabled", "disabled");
            $("#btn_tambah_satuan").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/Satuan/save') ?>',
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
                        $("#form_tambah_satuan")[0].reset();
                        $("#addsatuan").modal('hide');
                        $('#tablesatuan').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        satuan.forEach(function(item) {
                            $("#" + item).removeClass('form-control-danger');
                            $("#" + item).removeClass('form-control-success');
                            $("#error" + item).html('');
                            $("#error" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_tambah_satuan").removeAttr("disabled");
                    $("#btn_tambah_satuan").html("Tambah");
                }
            });
        }
    });
});

// edit satuan
$(document).on('click', '.edit_satuan', function() {
    const id = $(this).attr('id');
    $.ajax({
        url: '<?= base_url('Admin/Satuan/edit') ?>',
        method: 'post',
        data: {
            id_satuan: id
        },
        dataType: 'json',
        success: function(response) {
            $('#editsatuan').modal('show');
            $.each(response.data, function(key, value) {
                $('#edit' + key).val(value);
            });

        }
    });
});

// update satuan
$(function() {
    $("#form_edit_satuan").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_edit_satuan").attr("disabled", "disabled");
            $("#btn_edit_satuan").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/Satuan/update') ?>',
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
                        $("#form_edit_satuan")[0].reset();
                        $("#editsatuan").modal('hide');
                        $('#tablesatuan').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        satuan.forEach(function(item) {
                            $("#edit" + item).removeClass('form-control-danger');
                            $("#edit" + item).removeClass('form-control-success');
                            $("#erroredit" + item).html('');
                            $("#erroredit" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_edit_satuan").removeAttr("disabled");
                    $("#btn_edit_satuan").html("Edit");
                }
            });
        }
    });
});

// delete satuan
$(document).on('click', '.delete_satuan', function() {
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
                    url: '<?= base_url('Admin/Satuan/delete') ?>',
                    method: 'post',
                    data: {
                        id_satuan: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#tablesatuan').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                    }
                });
            }
        });
});


// change status
$(document).on('click', '.change_status_satuan', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/Satuan/updateStatus') ?>',
        method: 'post',
        data: {
            id_satuan: id
        },
        dataType: 'json',
        success: function(response) {
            // satuan').DataTable().ajax.reload();
            getSwall(response.status, response.data);
        }
    });
});
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>