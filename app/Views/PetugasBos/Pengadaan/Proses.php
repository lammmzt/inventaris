<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20 card-box">
                <!-- <h5 class="h4 text-blue mb-20">Form Edit pengadaan Masuk</h5> -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <a href="<?= base_url('PetugasBOS/Pengadaan'); ?>" class="btn btn-primary"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <form id="form_tambah_pengadaan" class="mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nama_user" class="col-sm-4 col-form-label">Nama Pemohon<span
                                        class="rq">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required" id="nama_user" name="nama_user"
                                        value="<?= $nama_user; ?>" readonly>
                                    <div class="form-control-feedback " id="errornama_user"></div>
                                </div>
                            </div>
                        </div>
                        <!-- ket -->
                        <div class="col-md-6">
                            <input type="hidden" id="id_pengadaan" name="id_pengadaan" value="<?= $id_pengadaan; ?>">
                            <div class="form-group row">
                                <label for="tgl_pengadaan" class="col-sm-4 col-form-label">Tanggal<span
                                        class="rq">*</span></label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control required" id="tgl_pengadaan"
                                        name="tgl_pengadaan" value="<?= $tgl_pengadaan; ?>" readonly>
                                    <div class="form-control-feedback " id="errortgl_pengadaan"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="status_pengadaan" class="col-sm-4 col-form-label">Status<span
                                        class="rq">*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control required" id="status_pengadaan" name="status_pengadaan">
                                        <option value="2" <?= $status_pengadaan == '2' ? 'selected' : ''; ?>>Disetujui
                                        </option>
                                        <option value="3" <?= $status_pengadaan == '3' ? 'selected' : ''; ?>>Proses
                                            Pengadaan
                                        </option>
                                    </select>
                                    <div class="form-control-feedback " id="errorstatus_pengadaan"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="ket_pengadaan" class="col-sm-4 col-form-label">Keterangan<span
                                        class="rq">*</span></label></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control required" id="ket_pengadaan" name="ket_pengadaan"
                                        readonly
                                        placeholder="Masukan ket_pengadaan pengadaan"><?= $ket_pengadaan; ?></textarea>
                                    <div class="form-control-feedback " id="errorket_pengadaan"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive pt-4">
                        <table class="table table table-striped" id="tableDetailBarang">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center datatable-nosort">#</th>
                                    <th scope="col" class="datatable-nosort">Nama ATK</th>
                                    <th scope="col" class="datatable-nosort">Spek</th>
                                    <th scope="col" class="text-center datatable-nosort" style="width: 250px;">
                                        Permintaan</th>
                                    <th scope="col" class="text-center datatable-nosort" style="width: 250px;">Catatan
                                    </th>
                                    <th scope="col" class="text-center datatable-nosort" style="width: 150px;">Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary float-right" id="btn_simpan">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- ======================================== END pengadaan ======================================== -->

<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// dataTables trans Masuk
function dataTablesDetailBarang() {
    $('#tableDetailBarang').DataTable({
        processing: true,
        serverSide: true,
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        ajax: {
            url: '<?= base_url('Admin/Pengadaan/DataTablesDetailPengadaan') ?>',
            type: 'POST',
            data: function(data) {
                data.id_pengadaan = $('#id_pengadaan').val();
            }
        },
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],

        // search, paging, info false
        // searching: false,
        // paging: false,
        // info: false,

        // remove order default sorting
        order: [],

        columns: [{
                data: null,
                class: "text-center",
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'nama_barang',
                class: 'table-plus'
            },
            {
                data: 'nama_spek',
                class: ''
            },
            {
                data: 'qty',
                class: 'text-center'
            },
            {
                data: 'catatan_detail_pengadaan',
                class: 'text-center'
            },
            {
                data: 'status_detail',
                class: 'text-center'
            },

        ],
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
    });
}

$(document).ready(function() {
    dataTablesDetailBarang();
});


// get data tipe barang
document.addEventListener('DOMContentLoaded', function() {
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


// event change tipe barang
$('#tipe_barang_id').change(function() {
    if ($('#tipe_barang_id').val() !== '') {
        $('#btn_plus').prop('disabled', false);
    } else {
        $('#btn_plus').attr('disabled', true);
    }
});


// event focus lost input qty
$(document).on('focusout', '.input_qty', function() {
    const id = $(this).attr('id');
    const qty = $(this).val();
    // alert(qty);
    var data = {
        id_detail_pengadaan: id,
        qty: qty
    };

    // alert(data);

    $.ajax({
        url: '<?= base_url('Admin/Pengadaan/updateQty') ?>',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status != '200') {
                getSwall(response.status, response.data);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
});

// event focus lost input spek
$(document).on('focusout', '.input_spek', function() {
    const id = $(this).attr('id');
    const spek = $(this).val();
    // alert(spek);
    var data = {
        id_detail_pengadaan: id,
        spek: spek
    };

    // alert(data);
    $.ajax({
        url: '<?= base_url('Admin/Pengadaan/updateSpek') ?>',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status != '200') {
                getSwall(response.status, response.data);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
});


// event focus lost input catatan
$(document).on('focusout', '.input_catatan', function() {
    const id = $(this).attr('id');
    const catatan = $(this).val();
    // alert(catatan);
    var data = {
        id_detail_pengadaan: id,
        catatan: catatan
    };

    // alert(data);
    $.ajax({
        url: '<?= base_url('Admin/Pengadaan/updateCatatan') ?>',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status != '200') {
                getSwall(response.status, response.data);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
});

// event click button update
$('#btn_simpan').click(function() {
    $("#btn_simpan").attr("disabled", "disabled");
    $("#btn_simpan").html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
    );
    var data = {
        id_pengadaan: $('#id_pengadaan').val(),
        status_pengadaan: $('#status_pengadaan').val()
    };


    $.ajax({
        url: '<?= base_url('Admin/Pengadaan/UpdateProsesPenerimaan') ?>',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                getSwall(response.status, response.data);
                setTimeout(function() {
                    window.location.href = '<?= base_url('PetugasBOS/Pengadaan'); ?>';
                }, 1500);
            } else {
                getSwall(response.status, response.data);
                $("#btn_simpan").removeAttr("disabled");
                $("#btn_simpan").html('Update');
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
});
</script>


<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>