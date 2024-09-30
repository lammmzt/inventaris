<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20 card-box">
                <!-- <h5 class="h4 text-blue mb-20">Form Edit pengadaan Masuk</h5> -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <a href="<?= base_url('KaTU/Pengadaan'); ?>" class="btn btn-primary"><i
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
                                    <input type="date" class="form-control required" id="nama_user" name="nama_user"
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
                        <!-- ket -->

                    </div>
                    <div class="form-group row">
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
                                    <th scope="col" class="datatable-nosort" style="width: 250px;">Spek</th>
                                    <th scope="col" class="text-center datatable-nosort" style="width: 100px;">
                                        Permintaan</th>
                                    <th scope="col" class="text-center datatable-nosort" style="width: 250px;">Catatan
                                    </th>
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
                data: 'status_detail_pengadaan',
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
function getTipeBarang() {
    $.ajax({
        url: '<?= base_url('Admin/Barang/Detail/fetchTipeBarangByJenisBarang') ?>',
        data: {
            jenis_barang: 1
        },
        method: 'post',
        dataType: 'json',
        success: function(response) {
            var html = '';
            html += '<option value="">Pilih Barang</option>';
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

// when click button delete
$(document).on('click', '.delete_pengadaan', function() {
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
                url: '<?= base_url('Admin/Pengadaan/Delete') ?>',
                method: 'post',
                data: {
                    id_detail_pengadaan: id
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
$('#tipe_barang_id').change(function() {
    if ($('#tipe_barang_id').val() !== '') {
        $('#btn_plus').prop('disabled', false);
    } else {
        $('#btn_plus').attr('disabled', true);
    }
});

// function to update detail
function updateDetailPengadaan() {
    var tipe_barang_id = $('#tipe_barang_id').val();
    var id_pengadaan = $('#id_pengadaan').val();
    // alert(tipe_barang_id);

    var data = {
        tipe_barang_id: tipe_barang_id,
        id_pengadaan: id_pengadaan,
    };
    $.ajax({
        url: '<?= base_url('Admin/Pengadaan/updatePengadaan') ?>',
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
    updateDetailPengadaan();
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

    // get all input_status value and id
    var data = [];
    $("#btn_simpan").attr("disabled", "disabled");
    $("#btn_simpan").html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
    );
    $('.input_status').each(function() {
        var id = $(this).attr('id');
        var status = $(this).val();
        if (status == '') {
            $(this).focus();
            $("#btn_simpan").removeAttr("disabled");
            $("#btn_simpan").html('Simpan');
            getSwall('error', 'Status belum dipilih');
            data = [];
            return false;
        } else {
            data.push({
                id: id,
                status: status
            });
        }
    });

    // console.log(data);
    // alert(data);

    if (data.length > 0) {
        $.ajax({
            url: '<?= base_url('KaTU/Pengadaan/UpdateProsesPersetujuan') ?>',
            method: 'post',
            data: {
                detail_data: data,
                id_pengadaan: $('#id_pengadaan').val()
            },
            dataType: 'json',
            success: function(response) {
                if (response.status != '200') {
                    getSwall(response.status, response.data);
                } else {
                    getSwall(response.status, response.data);
                    $("#btn_simpan").removeAttr("disabled");
                    $("#btn_simpan").html('Simpan');
                    setTimeout(function() {
                        window.location.href = '<?= base_url('KaTU/Pengadaan'); ?>';
                    }, 1500);
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    }
});
</script>


<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>