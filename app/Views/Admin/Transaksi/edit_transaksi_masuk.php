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
                <form id="form_tambah_transaksi_masuk" class="mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" id="id_transaksi" name="id_transaksi" value="<?= $id_transaksi; ?>">
                            <div class="form-group row">
                                <label for="tgl_transaksi" class="col-sm-4 col-form-label">Tanggal<span
                                        class="rq">*</span></label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control required" id="tgl_transaksi"
                                        name="tgl_transaksi" value="<?= $tgl_transaksi; ?>">
                                    <div class="form-control-feedback " id="errortgl_transaksi"></div>
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
                                        placeholder="Masukan ket_transaksi transaksi"><?= $ket_transaksi; ?></textarea>
                                    <div class="form-control-feedback " id="errorket_transaksi"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_atk" class="col-sm-2 col-form-label">Nama ATK<span
                                class="rq">*</span></label></label>
                        <div class="col-sm-9">
                            <select class="custom-select2 form-control" name="id_atk" id="id_atk"
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
                        <table class="table table table-striped" id="tableDetailBarang">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center datatable-nosort">#</th>
                                    <th scope="col" class="datatable-nosort">Nama ATK</th>
                                    <th scope="col" class="datatable-nosort text-center">Stok</th>
                                    <th scope="col" class="text-center datatable-nosort" style="width: 250px;">
                                        Permintaan</th>
                                    <th scope="col" class="text-center datatable-nosort" style="width: 150px;">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary float-right" id="btn_update">Update</button>
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
                data: 'action',
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

// when click button delete
$(document).on('click', '.deleteTransMasuk', function() {
    const id = $(this).attr('id');
    // alert(id);
    swal({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '<?= base_url('Admin/ATK/Transaksi/deleteTransMasuk') ?>',
                method: 'post',
                data: {
                    id_detail_transaksi: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == '200') {
                        getSwall(response.status, response.data);
                        $('#tableDetailBarang').DataTable().ajax.reload();
                    } else {
                        getSwall(response.status, response.data);
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    });
});

// event change tipe barang
$('#id_atk').change(function() {
    if ($('#id_atk').val() !== '') {
        $('#btn_plus').prop('disabled', false);
    } else {
        $('#btn_plus').attr('disabled', true);
    }
});

// function to update detail
function updatedDetailTransMasuk() {
    var id_atk = $('#id_atk').val();
    var id_transaksi = $('#id_transaksi').val();

    var data = {
        id_atk: id_atk,
        id_transaksi: id_transaksi,
        qty: 1
    };
    $.ajax({
        url: '<?= base_url('Admin/ATK/Transaksi/updateDetailATKMasuk') ?>',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                getSwall(response.status, response.data);
                $('#tableDetailBarang').DataTable().ajax.reload();
            } else {
                getSwall(response.status, response.data);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
}

// event click button plus
$('#btn_plus').click(function() {
    updatedDetailTransMasuk();
});


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

// event click button update
$('#btn_update').click(function() {
    var id_transaksi = $('#id_transaksi').val();
    var tanggal_transaksi = $('#tgl_transaksi').val();
    var ket_transaksi = $('#ket_transaksi').val();
    $("#btn_update").attr("disabled", "disabled");
    $("#btn_update").html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
    );
    // alert(tgl_transaksi);
    var data = {
        id_transaksi: id_transaksi,
        tanggal_transaksi: tanggal_transaksi,
        ket_transaksi: ket_transaksi
    };

    $.ajax({
        url: '<?= base_url('Admin/ATK/Transaksi/updateTransMasuk') ?>',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                getSwall(response.status, response.data);
                $("#btn_update").removeAttr("disabled");
                $("#btn_update").html('Update');
                $('#tableDetailBarang').DataTable().ajax.reload();
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