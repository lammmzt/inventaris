<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20 card-box">
                <!-- <h5 class="h4 text-blue mb-20">Form Transaksi Masuk</h5> -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <a href="<?= base_url('Pegawai/ATK/Transaksi'); ?>" class="btn btn-primary"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <form id="form_tambah_transaksi_keluar" class="mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="tgl_transaksi" class="col-sm-4 col-form-label">Tanggal<span
                                        class="rq">*</span></label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control required" id="tgl_transaksi"
                                        name="tgl_transaksi" readonly value="<?= date('Y-m-d'); ?>">
                                    <div class="form-control-feedback " id="errortgl_transaksi"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="ket_transaksi" class="col-sm-4 col-form-label">Keterangan<span
                                        class="rq">*</span></label></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control required" id="ket_transaksi" name="ket_transaksi"
                                        placeholder="Masukan ket transaksi"></textarea>
                                    <div class="form-control-feedback " id="errorket_transaksi"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="atk_id" class="col-sm-2 col-form-label">Nama ATK<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-9">
                            <select class="custom-select2 form-control" name="atk_id" id="atk_id"
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
                                    <th scope="col">Nama ATK</th>
                                    <th scope="col" class="text-center" style="width: 250px;">QTY</th>
                                    <th scope="col" class="text-center" style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_transaksi">
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

<!-- ======================================== END transaksi ======================================== -->

<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// get data tipe barang
function getATK() {
    $.ajax({
        url: '<?= base_url('Admin/ATK/fetchAll') ?>',
        method: 'post',
        dataType: 'json',
        success: function(response) {
            var html = '';
            html += '<option value="">Pilih ATK</option>';
            $.each(response.data, function(key, value) {
                html += '<option value="' + value.id_atk + '">' + value.nama_barang +
                    ' - ' + value.nama_tipe_barang + '(' + value.merek_atk + ')' + ' @ ' + value
                    .nama_satuan +
                    '</option>';
                // html += '<option value="' + value.id_atk + '">' + +
                //     ' - ' + value.nama_tipe_barang + '(' + value.merek_atk + ')' +
                //     '</option>';
            });
            $('#atk_id').html(html);
        }
    });
};

$(document).ready(function() {
    getATK();
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

var detail_transaksi = [];

// event change tipe barang
$('#atk_id').change(function() {
    if ($('#atk_id').val() !== '') {
        $('#btn_plus').prop('disabled', false);
    } else {
        $('#btn_plus').attr('disabled', true);
    }
});

// fungsi tambah detail transaksi
function addDetailTransaksi() {
    var atk_id = $('#atk_id').val();
    var atk_text = $('#atk_id option:selected').text();
    var qty = 1;
    var index = detail_transaksi.findIndex(x => x.atk_id == atk_id);
    if (index == -1) {
        detail_transaksi.push({
            atk_id: atk_id,
            atk_text: atk_text,
            qty: qty
        });
    } else {
        detail_transaksi[index].qty = parseInt(detail_transaksi[index].qty) + 1;
    }
    renderDetailTransaksi();
}


// fungsi render detail transaksi
function renderDetailTransaksi() {
    var html = '';
    $.each(detail_transaksi, function(key, value) {
        html += '<tr>';
        html += '<td class="text-center">' + (key + 1) + '</td>';
        html += '<td>' + value.atk_text + '</td>';
        html +=
            '<td class="text-center"><input type="number" class="form-control text-center input_qty" style="min-width: 100px;" min="1" value="' +
            value
            .qty +
            '" id="qty_' + key + '"></td>';
        html +=
            '<td class="text-center"><button type="button" class="btn btn-danger" onclick="deleteDetailTransaksi(' +
            key + ')">Hapus</button></td>';
        html += '</tr>';
    });
    $('#tbody_transaksi').html(html);
}

// fungsi hapus detail transaksi
function deleteDetailTransaksi(index) {
    detail_transaksi.splice(index, 1);
    renderDetailTransaksi();
    if (detail_transaksi.length == 0) {
        $('#tbody_transaksi').html(
            '<tr><td colspan="4" class="text-center">Data Kosong</td></tr>');
    }
}

// event click button simpan
$('#btn_plus').click(function() {
    addDetailTransaksi();
});

// event change input qty
$(document).on('change', '.input_qty', function() {
    var index = $(this).attr('id').split('_')[1];
    detail_transaksi[index].qty = $(this).val();
    renderDetailTransaksi();
});

// event click button simpan                    
$('#btn_simpan').click(function() {
    if (detail_transaksi.length == 0) {
        swal({
            title: 'Data Kosong',
            type: 'error',
            showCancelButton: false,
            showConfirmButton: true,
            timer: 1500
        });
        return;
    }

    var tgl_transaksi = $('#tgl_transaksi').val();
    var ket_transaksi = $('#ket_transaksi').val();
    var user_id = $('#user_id').val();

    var data = {
        tgl_transaksi: tgl_transaksi,
        ket_transaksi: ket_transaksi,
        detail_transaksi: detail_transaksi,
    };

    if (user_id == '') {
        $("#user_id").addClass('form-control-danger');
        $("#erroruser_id").addClass('has-danger');
        $("#erroruser_id").html("User tidak boleh kosong");
        $('#user_id').focus();
        return false;
    } else {
        $('#erroruser_id').html('');
        $("#erroruser_id").removeClass('has-danger');
        $("#erroruser_id").addClass('has-success');
        $("#user_id").removeClass('form-control-danger');
    }

    if (tgl_transaksi == '') {
        $("#tgl_transaksi").addClass('form-control-danger');
        $("#errortgl_transaksi").addClass('has-danger');
        $("#errortgl_transaksi").html("Tanggal transaksi tidak boleh kosong");
        $('#tgl_transaksi').focus();
        return false;
    } else {
        $('#errortgl_transaksi').html('');
        $("#errortgl_transaksi").removeClass('has-danger');
        $("#errortgl_transaksi").addClass('has-success');
        $("#tgl_transaksi").removeClass('form-control-danger');
    }

    if (ket_transaksi == '') {
        $("#ket_transaksi").addClass('form-control-danger');
        $("#errorket_transaksi").addClass('has-danger');
        $("#errorket_transaksi").html("Keterangan transaksi tidak boleh kosong");
        $('#ket_transaksi').focus();
        return false;
    } else {
        $('#errorket_transaksi').html('');
        $("#errorket_transaksi").removeClass('has-danger');
        $("#errorket_transaksi").addClass('has-success');
        $("#ket_transaksi").removeClass('form-control-danger');
    }

    $("#btn_simpan").attr("disabled", "disabled");
    $("#btn_simpan").html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
    );
    // console.log(data);
    $.ajax({
        url: '<?= base_url('Admin/ATK/Transaksi/insertTransaksiKeluar') ?>',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                getSwall(response.status, response.data);
                $('#form_tambah_transaksi_keluar')[0].reset();
                detail_transaksi = [];
                renderDetailTransaksi();
                $('#user_id').val('');
                $('#user_id').trigger('change');
                $('#atk_id').val('');
                $('#atk_id').trigger('change');
                $('#tgl_transaksi').val('');
                $('#ket_transaksi').val('');
                $('#erroruser_id').html('');
                $("#erroruser_id").removeClass('has-danger');
                $("#erroruser_id").removeClass('has-success');
                $('#errortgl_transaksi').html('');
                $("#errortgl_transaksi").removeClass('has-danger');
                $("#errortgl_transaksi").removeClass('has-success');
                $("#tgl_transaksi").removeClass('form-control-danger');
                $('#errorket_transaksi').html('');
                $("#errorket_transaksi").removeClass('has-danger');
                $("#errorket_transaksi").removeClass('has-success');
                $("#ket_transaksi").removeClass('form-control-danger');
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