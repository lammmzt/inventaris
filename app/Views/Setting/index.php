<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-xl-12 col-sm-12 mb-30">
        <div class="card-box height-100-p overflow-hidden">
            <div class="profile-tab height-100-p">
                <div class="tab height-100-p">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#biodata" role="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#resetPass" role="tab">Reset Pass</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- biodata Tab start -->
                        <div class="tab-pane fade show active" id="biodata" role="tabpanel">
                            <div class="pd-20 mx-4 mt-4">
                                <div class="profile-setting py-2 mb-4">
                                    <form>
                                        <div class="form-group row">
                                            <label>Nama Lengkap</label>
                                            <input class="form-control form-control-lg" type="text" readonly
                                                id="nama_user">
                                        </div>
                                        <div class="form-group row">
                                            <label>Username</label>
                                            <input class="form-control form-control-lg" type="text" readonly
                                                id="username">
                                        </div>
                                        <div class="form-group row">
                                            <label>Role</label>
                                            <input class="form-control form-control-lg" type="text" readonly id="role">

                                        </div>
                                        <!-- status -->
                                        <div class="form-group row">
                                            <label>Status</label>
                                            <input class="form-control form-control-lg" type="text" readonly
                                                id="status_user">
                                        </div>

                                        <div class="form-group row">
                                            <label>Tanggal Buat</label>
                                            <input class="form-control form-control-lg" type="text" readonly
                                                id="created_at">
                                        </div>
                                        <!-- last login -->
                                        <div class="form-group row mb-4">
                                            <label>Last Login</label>
                                            <input class="form-control form-control-lg" type="text" readonly
                                                id="last_login">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- reset pass Tab End -->
                        <div class="tab-pane fade" id="resetPass" role="tabpanel">
                            <div class="pd-20 mx-4 mt-4">
                                <div class="profile-setting py-2">
                                    <form id="formResetPass" method="POST">
                                        <input type="hidden" name="id_user" id="id_user">
                                        <div class="form-group row">
                                            <label>Password lama</label>
                                            <input class="form-control form-control-lg" type="password" id="last_pass"
                                                required name="last_pass">
                                        </div>
                                        <div class="form-group row">
                                            <label>Password baru</label>
                                            <input class="form-control form-control-lg" type="password" id="new_pass"
                                                required name="new_pass">
                                        </div>
                                        <div class="form-group row">
                                            <label>Ulangi Password baru</label>
                                            <input class="form-control form-control-lg" type="password" id="re_new_pass"
                                                required name="re_new_pass">
                                        </div>

                                        <div class="form-group row mt-4">
                                            <button type="submit" class="btn btn-primary" id="btnResetPass">Update
                                                Password</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>

<?= $this->section('dataTables'); ?>



<script>
let userFileds = ['nama_user', 'username', 'role', 'created_at', 'last_login', 'id_user'];

function getUser() {
    $.ajax({
        url: '<?= base_url('Admin/User/fetchDataUser') ?>',
        type: 'POST',
        data: {
            username: '<?= session()->get('username') ?>'
        },
        success: function(response) {
            if (response.status == '200') {
                userFileds.forEach(function(item) {
                    $('#' + item).val(response.data[item]);
                });
                if (response.data.status_user == '1') {
                    $('#status_user').val('Aktif');
                } else {
                    $('#status_user').val('Tidak Aktif');
                }
            }
        }
    });
}

getUser();

function getSwall(status, message) {
    swal({
        title: message,
        type: status == '200' ? 'success' : 'error',
        showCancelButton: false,
        showConfirmButton: true,
        timer: 1500

    })
}

$("#formResetPass").submit(function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    // alert('test');
    if (!this.checkValidity()) {
        e.preventDefault();
    } else {
        $('#btnResetPass').html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        ).attr('disabled', true);
        $.ajax({
            url: '<?= base_url('Admin/User/updatePass') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == '200') {
                    getSwall(response.status, response.data);
                    $('#formResetPass').trigger('reset');
                    $('#btnResetPass').html('Update Password').attr('disabled', false);
                } else {
                    getSwall(response.status, response.data);
                    $('#btnResetPass').html('Update Password').attr('disabled', false);
                }
            }
        });
    }
});
</script>
<?= $this->endSection('dataTables'); ?>