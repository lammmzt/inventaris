<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20 card-box">
                <!-- <h5 class="h4 text-blue mb-20">Form Edit Transaksi Masuk</h5> -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <a href="<?= base_url('PetugasBOS/ATK/Transaksi'); ?>" class="btn btn-primary"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <form id="form_tambah_transaksi_masuk" class="mt-3">
                    <div class="row">
                        <!-- nama pemohon -->
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
                        <div class="col-md-6">
                            <input type="hidden" id="id_transaksi" name="id_transaksi" value="<?= $id_transaksi; ?>">
                            <div class="form-group row">
                                <label for="tgl_transaksi" class="col-sm-4 col-form-label">Tanggal<span
                                        class="rq">*</span></label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control required" id="tgl_transaksi"
                                        name="tgl_transaksi" value="<?= $tgl_transaksi; ?>" readonly>
                                    <div class="form-control-feedback " id="errortgl_transaksi"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- status -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="status_transaksi" class="col-sm-4 col-form-label">Status<span
                                        class="rq">*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control required" id="status_transaksi" name="status_transaksi">
                                        <option value="2" <?= $status_transaksi == '2' ? 'selected' : ''; ?>>Disetujui
                                        </option>
                                        <option value="3" <?= $status_transaksi == '3' ? 'selected' : ''; ?>>Proses
                                            Pengadaan</option>
                                    </select>
                                    <div class="form-control-feedback " id="errorstatus_transaksi"></div>
                                </div>
                            </div>
                        </div>
                        <!-- ket -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="ket_transaksi" class="col-sm-4 col-form-label">Keterangan<span
                                        class="rq">*</span></label></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control required" id="ket_transaksi" name="ket_transaksi"
                                        readonly
                                        placeholder="Masukan ket_transaksi transaksi"><?= $ket_transaksi; ?></textarea>
                                    <div class="form-control-feedback " id="errorket_transaksi"></div>
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
                                    <th scope="col" class="datatable-nosort text-center">Stok</th>
                                    <th scope="col" class="text-center datatable-nosort" style="width: 250px;">
                                        Permintaan</th>
                                    <th scope="col" class="text-center datatable-nosort" style="width: 250px;">
                                        Catatan</th>
                                    <th scope="col" class="text-center datatable-nosort">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary float-right" id="btn_simpan">Simpan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- ======================================== END transaksi ======================================== -->

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
            url: '<?= base_url('Admin/ATK/Transaksi/DataTablesEditTransMasuk') ?>',
            type: 'POST',
            data: function(data) {
                data.id_transaksi = $('#id_transaksi').val();
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
                data: 'qty_atk',
                class: 'text-center'
            },
            {
                data: 'qty',
                class: 'text-center'
            },
            {
                data: 'catatan_detail_transaksi',
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


function getSwall(status, message) {
    swal({
        title: message,
        type: status == '200' ? 'success' : 'error',
        showCancelButton: false,
        showConfirmButton: true,
        timer: 1500

    })
}



// event focus lost input qty
$(document).on('focusout', '.input_qty', function() {
    const id = $(this).attr('id');
    const qty = $(this).val();
    // alert(qty);
    var data = {
        id_detail_transaksi: id,
        qty: qty
    };

    // alert(data);

    $.ajax({
        url: '<?= base_url('Admin/ATK/Transaksi/updateQtyMasuk') ?>',
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
        id_detail_transaksi: id,
        catatan: catatan
    };

    // alert(data);
    $.ajax({
        url: '<?= base_url('Admin/ATK/Transaksi/updatedCatatan') ?>',
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

    var id_transaksi = $('#id_transaksi').val();
    var status_transaksi = $('#status_transaksi').val();

    var data = {
        id_transaksi: id_transaksi,
        status_transaksi: status_transaksi
    };

    $.ajax({
        url: '<?= base_url('PetugasBOS/ATK/Transaksi/UpdateProsesPengadaan') ?>',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                getSwall(response.status, response.data);
                setTimeout(function() {
                    window.location.href = '<?= base_url('PetugasBOS/ATK/Transaksi') ?>';
                }, 1500);
            } else {
                getSwall(response.status, response.data);
                $("#btn_simpan").removeAttr("disabled");
                $("#btn_simpan").html('Simpan');
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