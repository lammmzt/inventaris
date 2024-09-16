<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20 card-box">
                <!-- <h5 class="h4 text-blue mb-20">Form pengadaan Masuk</h5> -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <a href="<?= base_url('Admin/Pengadaan'); ?>" class="btn btn-primary"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <form id="form_tambah_pengadaan_masuk" class="mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="tgl_pengadaan" class="col-sm-4 col-form-label">Jenis Pengadaan<span
                                        class="rq">*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="jenis_pengadaan" id="jenis_pengadaan"
                                        style="width: 100%; height: 38px;">
                                        <option value="">Pilih Jenis Pengadaan</option>
                                        <option value="0">ATK</option>
                                        <option value="1">Inventaris</option>
                                    </select>
                                    <div class="form-control-feedback " id="errortgl_pengadaan"></div>
                                </div>
                            </div>
                        </div>
                        <!-- ket -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="ket_pengadaan" class="col-sm-4 col-form-label">Keterangan<span
                                        class="rq">*</span></label></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control required" id="ket_pengadaan" name="ket_pengadaan"
                                        placeholder="Masukan keterangan pengadaan"></textarea>
                                    <div class="form-control-feedback " id="errorket_pengadaan"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipe_barang_id" class="col-sm-2 col-form-label">Nama Barang<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-9">
                            <select class="custom-select2 form-control" name="tipe_barang_id" id="tipe_barang_id"
                                style="width: 100%; height: 38px;">

                            </select>
                        </div>
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-primary text-right d-flex align-items-center m-1"
                                id="btn_plus" disabled>
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive pt-4">
                        <table class="table table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col" class="text-center" style="width: 250px;">QTY</th>
                                    <th scope="col" class="text-center" style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_pengadaan">
                                <tr>
                                    <td colspan="4" class="text-center">Data Kosong</td>
                                </tr>

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

<style>
/* mx height table 500px and srroler down */
.table-responsive {
    max-height: 400px;
    overflow-y: auto;
}
</style>

<!-- ======================================== END pengadaan ======================================== -->

<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// get data tipe barang
function getTipeBarang(jenis_barang) {
    $.ajax({
        url: '<?= base_url('Admin/Barang/Detail/fetchTipeBarangByJenisBarang') ?>',
        data: {
            jenis_barang: jenis_barang
        },
        method: 'post',
        dataType: 'json',
        success: function(response) {
            var html = '';
            html += '<option value="">Pilih ATK</option>';
            if (response.status == '200') {
                $.each(response.data, function(key, value) {
                    html += '<option value="' + value.id_tipe_barang + '">' + value
                        .nama_barang + ' - ' + value.nama_tipe_barang + ' @' + value.nama_satuan +
                        '</option>';
                });
            }
            $('#tipe_barang_id').html(html);
        }
    });
};

$(document).ready(function() {
    getTipeBarang(0);
});

// when change jenis pengadaan
$('#jenis_pengadaan').change(function() {
    var jenis_barang = $(this).val();
    getTipeBarang(jenis_barang);
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

var detail_pengadaan = [];

// event change tipe barang
$('#tipe_barang_id').change(function() {
    if ($('#tipe_barang_id').val() !== '') {
        $('#btn_plus').prop('disabled', false);
    } else {
        $('#btn_plus').attr('disabled', true);
    }
});

// fungsi tambah detail pengadaan
function addDetailPengadaan() {
    var tipe_barang_id = $('#tipe_barang_id').val();
    var nama_barang = $('#tipe_barang_id option:selected').text();
    var qty = 1;
    var index = detail_pengadaan.findIndex(x => x.tipe_barang_id == tipe_barang_id);
    if (index == -1) {
        detail_pengadaan.push({
            tipe_barang_id: tipe_barang_id,
            nama_barang: nama_barang,
            qty: qty
        });
    } else {
        detail_pengadaan[index].qty = parseInt(detail_pengadaan[index].qty) + 1;
    }
    renderDetailpengadaan();
}


// fungsi render detail pengadaan
function renderDetailpengadaan() {
    var html = '';
    $.each(detail_pengadaan, function(key, value) {
        html += '<tr>';
        html += '<td class="text-center">' + (key + 1) + '</td>';
        html += '<td>' + value.nama_barang + '</td>';
        html +=
            '<td class="text-center"><input type="number" class="form-control text-center input_qty" style="min-width: 100px;" min="1" value="' +
            value
            .qty +
            '" id="qty_' + key + '"></td>';
        html +=
            '<td class="text-center"><button type="button" class="btn btn-danger" onclick="deleteDetailpengadaan(' +
            key + ')">Hapus</button></td>';
        html += '</tr>';
    });
    $('#tbody_pengadaan').html(html);
}

// fungsi hapus detail pengadaan
function deleteDetailpengadaan(index) {
    detail_pengadaan.splice(index, 1);
    renderDetailpengadaan();
    if (detail_pengadaan.length == 0) {
        $('#tbody_pengadaan').html(
            '<tr><td colspan="4" class="text-center">Data Kosong</td></tr>');
    }
}

// event click button simpan
$('#btn_plus').click(function() {
    addDetailPengadaan();
});

// event change input qty
$(document).on('change', '.input_qty', function() {
    var index = $(this).attr('id').split('_')[1];
    detail_pengadaan[index].qty = $(this).val();
    renderDetailpengadaan();
});

// event click button simpan                    
$('#btn_simpan').click(function() {
    if (detail_pengadaan.length == 0) {
        swal({
            title: 'Data Kosong',
            type: 'error',
            showCancelButton: false,
            showConfirmButton: true,
            timer: 1500
        });
        return;
    }

    if (ket_pengadaan == '') {
        $("#ket_pengadaan").addClass('form-control-danger');
        $("#errorket_pengadaan").addClass('has-danger');
        $("#errorket_pengadaan").html("Keterangan pengadaan tidak boleh kosong");
        $('#ket_pengadaan').focus();
        return false;
    } else {
        $('#errorket_pengadaan').html('');
        $("#errorket_pengadaan").removeClass('has-danger');
        $("#errorket_pengadaan").addClass('has-success');
        $("#ket_pengadaan").removeClass('form-control-danger');
    }

    var data = {
        tgl_pengadaan: tgl_pengadaan,
        ket_pengadaan: ket_pengadaan,
        detail_pengadaan: detail_pengadaan
    };

    $("#btn_simpan").attr("disabled", "disabled");
    $("#btn_simpan").html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
    );
    // console.log(data);
    $.ajax({
        url: '<?= base_url('Admin/Pengadaan/insertpengadaanMasuk') ?>',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                getSwall(response.status, response.data);
                $('#form_tambah_pengadaan_masuk')[0].reset();
                detail_pengadaan = [];
                renderDetailpengadaan();
                $('#tipe_barang_id').val('');
                $('#tipe_barang_id').trigger('change');
                $('#errorket_pengadaan').html('');
                $("#errorket_pengadaan").removeClass('has-danger');
                $("#errorket_pengadaan").removeClass('has-success');
                $("#ket_pengadaan").removeClass('form-control-danger');
                $("#btn_simpan").removeAttr("disabled");
                $("#btn_simpan").html('Simpan');
            } else {
                getSwall(response.status, response.data);
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