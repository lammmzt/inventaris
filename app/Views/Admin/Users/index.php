<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">Data User</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addUser" type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tableUsers">
                        <thead>
                            <tr>
                                <th class="table-plus">Username</th>
                                <th class="table-plus">Nama</th>
                                <th>Role</th>
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

<!-- ======================================== users ======================================== -->
<!-- modal addUser -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tambah User
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_user">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_user" class="col-sm-4 col-form-label">Nama User<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="nama_user" name="nama_user"
                                placeholder="Masukan nama User">
                            <div class="form-control-feedback " id="errornama_user"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label">Username<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="username" name="username"
                                placeholder="Masukan username">
                            <div class="form-control-feedback " id="errorusername"></div>
                        </div>
                    </div>
                    <!-- select -->
                    <div class="form-group row">
                        <label for="role" class="col-sm-4 col-form-label">Role<span class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="form-control required" id="role" name="role">
                                <option value="">Pilih Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Pegawai">Pegawai</option>
                                <option value="KA. TU">KA. TU</option>
                                <option value="Petugas BOS">Petugas BOS</option>
                                <option value="Kepala Sekolah">Kepala Sekolah</option>
                            </select>
                            <div class="form-control-feedback " id="errorrole"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_tambah_user">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edit User
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_edit_user">
                <div class="modal-body">
                    <input type="hidden" id="editid_user" name="id_user">
                    <div class="form-group row">
                        <label for="editnama_user" class="col-sm-4 col-form-label">Nama User<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editnama_user" name="nama_user">
                            <div class="form-control-feedback " id="erroreditnama_user"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editusername" class="col-sm-4 col-form-label">Username<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editusername" name="username">
                            <div class="form-control-feedback " id="erroreditusername"></div>
                        </div>
                    </div>
                    <!-- select -->
                    <div class="form-group row">
                        <label for="editrole" class="col-sm-4 col-form-label">Role<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="form-control required" id="editrole" name="role">

                            </select>
                            <div class="form-control-feedback " id="erroreditrole"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn_edit_users">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal view -->
<div class="modal fade" id="viewuser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    View User
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="viewnama_user" class="col-sm-4 col-form-label">Nama User</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewnama_user" name="nama_user" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="viewusername" class="col-sm-4 col-form-label">Username</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewusername" name="username" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="viewrole" class="col-sm-4 col-form-label">Role</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewrole" name="role" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="viewlast_login" class="col-sm-4 col-form-label">Last Login</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewlast_login" name="last_login" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="viewcreated_at" class="col-sm-4 col-form-label">Created At</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewcreated_at" name="created_at" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="viewupdated_at" class="col-sm-4 col-form-label">Updated At</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="viewupdated_at" name="updated_at" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>


<!-- ======================================== END users ======================================== -->


<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// dataTables users
function dataTablesUsers() {
    $(document).ready(function() {
        $('#tableUsers').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/User/DataTables') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'username',
                    class: 'table-plus'
                },
                {
                    data: 'nama_user'
                },
                {
                    data: 'role'
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
    dataTablesUsers();
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

// ======================================== users ========================================

// DATA
const users = [
    'nama_user',
    'username',
    'role',
    'id_user'
];


// tambah 
$(function() {
    $("#form_tambah_user").submit(function(e) {
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
                url: '<?= base_url('Admin/User/save') ?>',
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
                        $("#form_tambah_user")[0].reset();
                        $("#addUser").modal('hide');
                        $('#tableUsers').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        users.forEach(function(item) {
                            $("#" + item).removeClass('form-control-danger');
                            $("#" + item).removeClass('form-control-success');
                            $("#error" + item).html('');
                            $("#error" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_tambah_user").removeAttr("disabled");
                    $("#btn_tambah_user").html("Tambah");
                }
            });
        }
    });
});

// edit user
$(document).on('click', '.edit_user', function() {
    const id = $(this).attr('id');
    $.ajax({
        url: '<?= base_url('Admin/User/edit') ?>',
        method: 'post',
        data: {
            id_user: id
        },
        dataType: 'json',
        success: function(response) {
            $('#edituser').modal('show');
            $.each(response.data, function(key, value) {
                $('#edit' + key).val(value);
            });
            // add select in edit
            $('#editrole').html(
                `<option value="">Pilih Role</option>
                <option value="Admin" ${response.data.role == 'Admin' ? 'selected' : ''}>Admin</option>
                <option value="Pegawai" ${response.data.role == 'Pegawai' ? 'selected' : ''}>Pegawai</option>
                <option value="KA. TU" ${response.data.role == 'KA. TU' ? 'selected' : ''}>KA. TU</option>
                <option value="Petugas BOS" ${response.data.role == 'Petugas BOS' ? 'selected' : ''}>Petugas BOS</option>
                <option value="Kepala Sekolah" ${response.data.role == 'Kepala Sekolah' ? 'selected' : ''}>Kepala Sekolah</option>`

            );

        }
    });
});

// update user
$(function() {
    $("#form_edit_user").submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        if (!this.checkValidity()) {
            e.preventDefault();
            $(this).addClass('form-control-success');
        } else {
            $("#btn_edit_user").attr("disabled", "disabled");
            $("#btn_edit_user").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            $.ajax({
                url: '<?= base_url('Admin/User/update') ?>',
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
                        $("#form_edit_user")[0].reset();
                        $("#edituser").modal('hide');
                        $('#tableUsers').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        users.forEach(function(item) {
                            $("#edit" + item).removeClass('form-control-danger');
                            $("#edit" + item).removeClass('form-control-success');
                            $("#erroredit" + item).html('');
                            $("#erroredit" + item).removeClass('has-danger');
                        });
                    }
                    $("#btn_edit_user").removeAttr("disabled");
                    $("#btn_edit_user").html("Edit");
                }
            });
        }
    });
});

// delete user
$(document).on('click', '.delete_user', function() {
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
                    url: '<?= base_url('Admin/User/delete') ?>',
                    method: 'post',
                    data: {
                        id_user: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#tableUsers').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                    }
                });
            }
        });
});

// view user
$(document).on('click', '.view_user', function() {
    const id = $(this).attr('id');
    $.ajax({
        url: '<?= base_url('Admin/User/edit') ?>',
        method: 'post',
        data: {
            id_user: id
        },
        dataType: 'json',
        success: function(response) {
            $('#viewuser').modal('show');
            $.each(response.data, function(key, value) {
                $('#view' + key).val(value);
            });
        }
    });
});

// reset password
$(document).on('click', '.reset_pass', function() {
    const id = $(this).attr('id');
    swal({
            title: "Apakah anda yakin?",
            text: "Password akan direset menjadi default!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Ya, Reset!",
            confirmButtonClass: "btn btn-success margin-5",
            cancelButtonText: "Batal",
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= base_url('Admin/User/reset') ?>',
                    method: 'post',
                    data: {
                        id_user: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        getSwall(response.status, response.data);
                    }
                });
            }
        });
});

// change status
$(document).on('click', '.change_status_user', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/User/changeStatus') ?>',
        method: 'post',
        data: {
            id_user: id
        },
        dataType: 'json',
        success: function(response) {
            // $('#tableUsers').DataTable().ajax.reload();
            getSwall(response.status, response.data);
        }
    });
});
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>