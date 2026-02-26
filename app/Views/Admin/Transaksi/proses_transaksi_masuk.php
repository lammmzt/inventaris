<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20 card-box">
                <!-- <h5 class="h4 text-blue mb-20">Form Edit Transaksi Masuk</h5> -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <a href="<?= base_url('Admin/ATK/Transaksi'); ?>" class="btn btn-primary"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <form id="form_tambah_transaksi_keluar">
                    <input type="hidden" name="id_transaksi" id="id_transaksi" value="<?= $id_transaksi; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="tanggal_transaksi" class="col-sm-4 col-form-label">Tanggal<span
                                        class="rq">*</span></label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="tanggal_transaksi" readonly
                                        name="tanggal_transaksi" value="<?= $tanggal_transaksi; ?>">
                                    <div class="form-control-feedback " id="errortanggal_transaksi"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="status_transaksi" class="col-sm-4 col-form-label">Status<span
                                        class="rq">*</span></label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="status_transaksi" name="status_transaksi">
                                        <option value="3" <?= $status_transaksi == 3 ? 'selected' : ''; ?>>Proses
                                            Pengadaan
                                        </option>
                                        <option value="4" <?= $status_transaksi == 4 ? 'selected' : ''; ?>>Selesai
                                        </option>
                                    </select>
                                    <div class="form-control-feedback " id="errorstatus_transaksi"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- ket -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="ket_transaksi" class="col-sm-4 col-form-label">Keterangan<span
                                        class="rq">*</span></label></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="ket_transaksi" name="ket_transaksi" readonly
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
                                    <th scope="col" class="text-center datatable-nosort">Permintaan</th>
                                    <th scope="col" class="text-center datatable-nosort" style="width: 250px;">Catatan
                                    </th>
                                    <th scope="col" class="text-center datatable-nosort">Status</th>
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
<div class="modal fade" id="modalEditBarang" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Ubah Barang
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_upadate_nama_atk" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_detail_transaksi" id="id_detail_transaksi">
                    <!-- button ketika tidak menemukan nama atk maka akan diarahkan ke halaman atk -->
                    <a href="<?= base_url('Admin/ATK'); ?>" class="float-right btn btn-primary " target="_blank"><i
                            class="icon-copy fa fa-edit" aria-hidden="true"></i>
                        ATK</a>
                    <div class="form-group row">
                        <label for="id_atk" class="col-sm-4 col-form-label"> Nama ATK<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-8">
                            <select class="custom-select2 form-control" name="id_atk" id="id_atk"
                                style="width: 100%; height: 38px;">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" id="btn_update_atk">
                        Edit
                    </button>
                </div>
            </form>
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
// dataTables trans Masuk
function dataTablesDetailBarang() {
    $('#tableDetailBarang').DataTable({
        processing: true,
        serverSide: true,
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        ajax: {
            url: '<?= base_url('Admin/ATK/Transaksi/DataTablesEditTransMasukAdmin') ?>',
            type: 'POST',
            data: function(data) {
                data.id_transaksi = $('#id_transaksi').val();
            }
        },
        // "lengthMenu": [
        //     [5, 10, 25, 50, -1],
        //     [5, 10, 25, 50, "All"]
        // ],

        // search, paging, info false
        searching: false,
        paging: false,
        info: false,

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

// get data tipe barang
function getATK(id_atk) {
    $.ajax({
        url: '<?= base_url('Admin/ATK/fetchAll') ?>',
        method: 'post',
        dataType: 'json',
        success: function(response) {
            var html = '';
            html += '<option value="">Pilih ATK</option>';
            $.each(response.data, function(key, value) {
                if (value.id_atk == id_atk) {
                    html += '<option selected value="' + value.id_atk + '" data-stok="' + value
                        .qty_atk + '">' +
                        value.nama_barang + '(' + value.barcode_atk + ')' +
                        ' - ' + value.nama_tipe_barang + '(' + value.merek_atk + ')' + ' @ ' + value
                        .nama_satuan +
                        '</option>';
                } else {
                    html += '<option value="' + value.id_atk + '" data-stok="' + value.qty_atk +
                        '">' +
                        value.nama_barang + '(' + value.barcode_atk + ')' +
                        ' - ' + value.nama_tipe_barang + '(' + value.merek_atk + ')' + ' @ ' + value
                        .nama_satuan +
                        '</option>';
                }
                // html += '<option value="' + value.id_atk + '">' + +
                //     ' - ' + value.nama_tipe_barang + '(' + value.merek_atk + ')' +
                //     '</option>';
            });
            $('#id_atk').html(html);
        }
    });
};

getATK();


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
        url: '<?= base_url('Admin/ATK/Transaksi/updateQtyKeluar') ?>',
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

    var data = {
        id_transaksi: $('#id_transaksi').val(),
        status_transaksi: $('#status_transaksi').val()
    };

    $.ajax({
        url: '<?= base_url('Admin/ATK/Transaksi/updatePenerimaanTransMasuk') ?>',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                $.ajax({
                    url: '<?= base_url('Notifikasi/createNotifikasi') ?>',
                    method: 'post',
                    data: {
                        penerima_notifikasi: '',
                        isi_notifikasi: 'Status trasaksi masuk telah diubah menjadi ' + $(
                            '#status_transaksi').find(
                            'option:selected').text(),
                        role: 'KA. TU'
                    },
                    success: function(response) {
                        if (response.status == '200') {
                            console.log('Notifikasi berhasil ditambahkan');
                        } else {
                            console.log('Notifikasi gagal ditambahkan');
                        }
                    }
                });
                $.ajax({
                    url: '<?= base_url('Notifikasi/createNotifikasi') ?>',
                    method: 'post',
                    data: {
                        penerima_notifikasi: '',
                        isi_notifikasi: 'Status trasaksi masuk telah diubah menjadi ' + $(
                            '#status_transaksi').find(
                            'option:selected').text(),
                        role: 'Petugas BOS'
                    },
                    success: function(response) {
                        if (response.status == '200') {
                            console.log('Notifikasi berhasil ditambahkan');
                        } else {
                            console.log('Notifikasi gagal ditambahkan');
                        }
                    }
                });
                getSwall(response.status, response.data);
                setTimeout(function() {
                    window.location.href = '<?= base_url('Admin/ATK/Transaksi') ?>';
                }, 2000);
            } else {
                getSwall(response.status, response.data);
            }
        },
        error: function(err) {
            console.log(err);
        }

    });
});

// when click the button edit pemesanan
$(document).on('click', '.editBarang', function() {
    const id = $(this).attr('data-id');
    // console.log(id);
    $.ajax({
        url: '<?= base_url('Admin/ATK/Transaksi/fetchDetailTransByIdDetailTrans') ?>',
        method: 'post',
        data: {
            id_detail_transaksi: id
        },
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                $('#id_detail_transaksi').val(response.data.id_detail_transaksi);
                // console.log(response.data);
                getATK(response.data.id_atk);
            } else {
                getSwall(response.status, response.data);
            }
        },
        error: function(err) {
            console.log(err);
        }

    });
});

// wehn submit form update nama atk
$(document).on("click", "#btn_update_atk", function(e) {
    e.preventDefault();

    let form = $("#form_upadate_nama_atk")[0];

    // cek validasi HTML5
    if (!form.checkValidity()) {
        form.reportValidity(); // tampilkan pesan validasi bawaan browser
        return;
    }

    // jika valid → jalan AJAX
    let formData = new FormData(form);

    if (!this.checkValidity()) {
        e.preventDefault();
        $(this).addClass('form-control-success');
    } else {
        $("#btn_update_atk").attr("disabled", "disabled");
        $("#btn_update_atk").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            url: '<?= base_url('Admin/ATK/Transaksi/updateAtkName') ?>',
            method: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                // alert(formData);
                if (response.error) {
                    if (typeof response.data == 'object') {
                        $.each(response.data, function(key, value) {
                            if (value != '') {
                                $("#edit" + key).addClass(
                                    'form-control-danger');
                                $("#erroredit" + key).addClass('has-danger');
                                $("#erroredit" + key).html(value);
                            } else {
                                $("#edit" + key).removeClass(
                                    'form-control-danger');
                                $("#edit" + key).addClass(
                                    'form-control-success');
                                $("#erroredit" + key).html('');
                                $("#erroredit" + key).removeClass('has-danger');
                            }
                        });
                    } else {
                        getSwall(response.status, response.data);
                    }
                } else {
                    $("#form_upadate_nama_atk")[0].reset();
                    $("#modalEditBarang").modal('hide');
                    $('#tableDetailBarang').DataTable().ajax.reload();
                    getSwall(response.status, response.data);
                }
                $("#btn_update_atk").removeAttr("disabled");
                $("#btn_update_atk").html("Edit");
            }
        });
    }
});
</script>


<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>