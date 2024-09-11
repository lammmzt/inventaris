<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <a href="<?= base_url('Admin/Barang'); ?>" class="btn btn-primary"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-11">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input class="form-control" type="text" readonly id="kode_barang"
                                        value="<?= $kode_barang; ?>" />
                                    <input class="form-control" type="hidden" readonly id="id_barang"
                                        value="<?= $id_barang; ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input class="form-control" type="text" readonly id="nama_barang"
                                        value="<?= $nama_barang; ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label>Jenis Barang</label>
                                    <input class="form-control" type="text" readonly id="jenis_barang"
                                        value="<?= ($jenis_barang == '1') ? 'Inventaris' : 'ATK'; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 text-right d-flex align-items-center">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addBarang" type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tableTipeBarang">
                        <thead>
                            <tr>
                                <th class="">Nama Tipe Barang</th>
                                <th class="">Status Tipe Barang</th>
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
                    Tambah Tipe Barang
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_barang">
                <div class="modal-body">
                    <input type="hidden" name="barang_id" value="<?= $id_barang; ?>">
                    <div class="form-group row">
                        <label for="nama_tipe_barang" class="col-sm-4 col-form-label">Nama Tipe Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="nama_tipe_barang"
                                name="nama_tipe_barang" placeholder="Masukan nama tipe barang">
                            <div class="form-control-feedback " id="errornama_tipe_barang"></div>
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
<div class="modal fade" id="edit_tipe_barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Edit tipe barang
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_edit_barang">
                <div class="modal-body">
                    <input type="hidden" id="editid_tipe_barang" name="id_tipe_barang">
                    <div class="form-group row">
                        <label for="editnama_tipe_barang" class="col-sm-4 col-form-label">Nama Tipe Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control required" id="editnama_tipe_barang"
                                name="nama_tipe_barang">
                            <div class="form-control-feedback " id="erroreditnama_tipe_barang"></div>
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
function dataTablesTipeBarang() {
    $(document).ready(function() {
        $('#tableTipeBarang').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '<?= base_url('Admin/Barang/Detail/DataTables') ?>',
                type: 'POST',
                data: function(data) {
                    data.id_barang = $('#id_barang').val();
                }
            },
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_tipe_barang',
                    class: 'table-plus'
                },
                {
                    data: 'status_tipe_barang',
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
    dataTablesTipeBarang();
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
    'nama_tipe_barang',
    'id_barang',
    'id_tipe_barang'
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
                url: '<?= base_url('Admin/Barang/Detail/save') ?>',
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
                                $("#" + key).addClass(
                                    'form-control-danger');
                                $("#error" + key).addClass(
                                    'has-danger');
                                $("#error" + key).html(value);
                            } else {
                                $("#" + key).removeClass(
                                    'form-control-danger');
                                $("#" + key).addClass(
                                    'form-control-success');
                                $("#error" + key).html('');
                                $("#error" + key).removeClass(
                                    'has-danger');
                            }
                        });
                    } else {
                        $("#form_tambah_barang")[0].reset();
                        $("#addBarang").modal('hide');
                        $('#tableTipeBarang').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        barang.forEach(function(item) {
                            $("#" + item).removeClass(
                                'form-control-danger');
                            $("#" + item).removeClass(
                                'form-control-success');
                            $("#error" + item).html('');
                            $("#error" + item).removeClass(
                                'has-danger');
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
$(document).on('click', '.edit_tipe_barang', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/Barang/Detail/edit') ?>',
        method: 'post',
        data: {
            id_tipe_barang: id
        },
        dataType: 'json',
        success: function(response) {
            // alert(response.data);
            $('#edit_tipe_barang').modal('show');
            $.each(response.data, function(key, value) {
                $('#edit' + key).val(value);
            });
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
                url: '<?= base_url('Admin/Barang/Detail/update') ?>',
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
                                $("#erroredit" + key).addClass(
                                    'has-danger');
                                $("#erroredit" + key).html(value);
                            } else {
                                $("#edit" + key).removeClass(
                                    'form-control-danger');
                                $("#edit" + key).addClass(
                                    'form-control-success');
                                $("#erroredit" + key).html('');
                                $("#erroredit" + key).removeClass(
                                    'has-danger');
                            }
                        });
                    } else {
                        $("#form_edit_barang")[0].reset();
                        $("#edit_tipe_barang").modal('hide');
                        $('#tableTipeBarang').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                        barang.forEach(function(item) {
                            $("#edit" + item).removeClass(
                                'form-control-danger');
                            $("#edit" + item).removeClass(
                                'form-control-success');
                            $("#erroredit" + item).html('');
                            $("#erroredit" + item).removeClass(
                                'has-danger');
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
$(document).on('click', '.delete_tipe_barang', function() {
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
                    url: '<?= base_url('Admin/Barang/Detail/delete') ?>',
                    method: 'post',
                    data: {
                        id_tipe_barang: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#tableTipeBarang').DataTable().ajax.reload();
                        getSwall(response.status, response.data);
                    }
                });
            }
        });
});


// change status
$(document).on('click', '.change_status_tipe_barang', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/Barang/Detail/updateStatus') ?>',
        method: 'post',
        data: {
            id_tipe_barang: id
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