<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>
<style>
.section {
    background-color: #ffffff;
    padding: 50px 30px;
    border: 1.5px solid #b2b2b2;
    border-radius: 0.25em;
}

#my-qr-reader {
    padding: 20px !important;
    border: 1.5px solid #b2b2b2 !important;
    border-radius: 8px;
}

#my-qr-reader img[alt="Info icon"] {
    display: none;
}

#my-qr-reader img[alt="Camera based scan"] {
    width: 100px !important;
    height: 100px !important;
}

button {
    padding: 10px 20px;
    border: 1px solid #b2b2b2;
    outline: none;
    border-radius: 0.25em;
    color: white;
    font-size: 15px;
    cursor: pointer;
    margin-top: 15px;
    margin-bottom: 10px;
    background-color: #008000ad;
    transition: 0.3s background-color;
}

button:hover {
    background-color: #008000;
}

#html5-qrcode-anchor-scan-type-change {
    text-decoration: none !important;
    color: #1d9bf0;

}

video {
    width: 100% !important;
    border: 1px solid #b2b2b2 !important;
    border-radius: 0.25em;
}
</style>
<div class="row mx-1">
    <div class="col-md-7">
        <div class="form-group row">
            <label for="barcodeInput" class="col-sm-4 col-form-label">Scan QR Codes</label></label>
            <input type="text" class="form-control" id="barcodeInput" placeholder="Scan QR Codes here..." autofocus>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6 mx-auto">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4 mx-2">
                    <h4 class="text-blue h4">Scan QR Codes</h4>
                </div>
                <div class="pb-20">
                    <div id="my-qr-reader">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modalDetail -->
<div class="modal fade" id="addinventaris" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tambah Pelaporan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_pelaporan" enctype="multipart/form-data">
                <!-- <form action="<?= base_url('Admin/Inventaris/Pelaporan/save') ?>" method="post"
                enctype="multipart/form-data"> -->
                <div class="modal-body">
                    <input type="hidden" name="inventaris_id" id="inventaris_id">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Kode Inventaris</label><input type="text" class="form-control"
                                    id="kode_inventaris" name="kode_inventaris" placeholder="Kode Inventaris" required
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nama Inventaris</label><input type="text" class="form-control"
                                    id="nama_inventaris" name="nama_inventaris" placeholder="Nama Barang" required
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Ruangan</label><input type="text" class="form-control" id="nama_ruangan"
                                    name="nama_ruangan" placeholder="Kode Inventaris" required readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Status Inventaris</label>
                                <input type="text" class="form-control" id="status_inventaris" name="status_inventaris"
                                    placeholder="Nama Barang" required readonly>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Keterangan <span class="rq">*</span></label>
                                <textarea type="text" class="form-control required" id="ket_pengecekan"
                                    name="ket_pengecekan" style="height: 50px;"
                                    placeholder="Masukan keterangan pengecekan" required></textarea>
                                <div class="form-control-feedback " id="errorket_pengecekan"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Status Pengecekan <span class="rq">*</span></label>
                                <select class="form-control required" id="status_pengecekan" name="status_pengecekan"
                                    required>
                                    <option value="">Pilih Status Pengecekan</option>
                                    <option value="1">Baik</option>
                                    <option value="2">Rusak</option>
                                    <option value="0">Hilang</option>
                                </select>
                                <div class="form-control-feedback" id="errorstatus_pengecekan"></div>
                            </div>
                        </div>
                    </div>
                    <!-- upload gambar -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="foto_pengecekan" class="col-sm-4 col-form-label">Upload Gambar</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="foto_pengecekan" name="foto_pengecekan"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-blue h4">History Pengecekan</h4>
                            <table class="table table-bordered table-hover" id="table_history_pengecekan">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Pelapor</th>
                                        <th class="text-center">Tanggal Pengecekan</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center" style="width: 100px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary" id="btn_tambah">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>
<script>
// notification
function getSwall(status, message) {
    swal({
        title: message,
        type: status == '200' ? 'success' : 'error',
        showCancelButton: false,
        showConfirmButton: true,
        timer: 1500,
        allowOutsideClick: false
    })
}

// get data 
function getDataInventaris(id) {
    $.ajax({
        url: '<?= base_url('Admin/Inventaris/fetchInventarisByKodeInventaris') ?>',
        method: 'post',
        data: {
            kode_inventaris: id
        },
        success: function(response) {
            if (response.status == '200') {
                $('#addinventaris').modal('show');
                $('#inventaris_id').val(response.data.inventaris.id_inventaris);
                $('#kode_inventaris').val(response.data.inventaris.kode_inventaris);
                $('#nama_inventaris').val(response.data.inventaris.nama_inventaris);
                $('#nama_ruangan').val(response.data.inventaris.nama_ruangan);
                if (response.data.inventaris.status_inventaris == '1') {
                    $('#status_inventaris').val('Baik');
                } else if (response.data.inventaris.status_inventaris == '2') {
                    $('#status_inventaris').val('Rusak');
                } else {
                    $('#status_inventaris').val('Hilang');
                }
                if (response.data.pelaporan.length > 0) {
                    $('#table_history_pengecekan tbody').empty();
                    $.each(response.data.pelaporan, function(index, value) {
                        $('#table_history_pengecekan tbody').append(
                            '<tr>' +
                            '<td class="text-center">' + (index + 1) + '</td>' +
                            '<td>' + value.nama_user + '</td>' +
                            '<td class="text-center">' + value.created_at + '</td>' +
                            '<td>' + value.ket_pengecekan + '</td>' +
                            '<td class="text-center">' + (value.foto_pengecekan == '' ?
                                'Tidak ada foto' :
                                '<a href="<?= base_url('Assets/uploads/pengecekan/') ?>' +
                                value.foto_pengecekan +
                                '" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>' +
                                '</td>') +
                            '<td class="text-center">' + (value.status_pengecekan ==
                                '1' ?
                                '<span class="badge badge-success">Baik</span>' :
                                (value.status_pengecekan == '2' ?
                                    '<span class="badge badge-warning">Rusak</span>' :
                                    '<span class="badge badge-danger">Hilang</span>')) +
                            '</td>' +
                            '</tr>'
                        );
                    });
                } else {
                    $('#table_history_pengecekan tbody').empty();
                    $('#table_history_pengecekan tbody').append(
                        '<tr>' +
                        '<td colspan="4" class="text-center">Tidak ada data</td>' +
                        '</tr>'
                    );
                }
            } else {
                getSwall(response.status, response.data);
            }
        },
        error: function() {
            getSwall('error', 'Data tidak ditemukan');
        }
    });
}

// submit form
$("#form_tambah_pelaporan").submit(function(e) {
    e.preventDefault();
    $("#btn_tambah").attr("disabled", "disabled");
    $("#btn_tambah").html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    $.ajax({
        url: '<?= base_url('Admin/Inventaris/Pelaporan/save') ?>',
        method: 'post',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.status == '200') {
                getSwall(response.status, response.data);
                $('#form_tambah_pelaporan')[0].reset();
                $('#table_history_pengecekan tbody').empty();
                $('#table_history_pengecekan tbody').append(
                    '<tr>' +
                    '<td colspan="4" class="text-center">Tidak ada data</td>' +
                    '</tr>'
                );
                $('#addinventaris').modal('hide');
                $("#btn_tambah").removeAttr("disabled");
                $("#btn_tambah").html('Simpan');
            } else {
                getSwall(response.status, response.data);
                $("#btn_tambah").removeAttr("disabled");
                $("#btn_tambah").html('Simpan');
            }
        }
    });
});

// script.js file
const result = document.getElementById("qr-result");

function domReady(fn) {
    if (
        document.readyState === "complete" ||
        document.readyState === "interactive"
    ) {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}


domReady(function() {

    // If found you qr code
    function onScanSuccess(decodeText, decodeResult) {
        textContent = decodeText;

        kode_inventaris = textContent.toString();

        // alert(kode_inventaris);
        getDataInventaris(kode_inventaris);
        // timer for next scan
        setTimeout(() => {
            htmlscanner.start();
        }, 10000);
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader", {
            fps: 10,
            qrbos: 250
        }
    );

    htmlscanner.render(onScanSuccess);


});



function handleBarcodeInput(event) {
    // Check if "Enter" key is pressed
    if (event.keyCode === 13) {

        const barcode = event.target.value;
        // alert(barcode);

        const barcodeString = barcode.toString();
        // alert(selectedMenu);
        getDataInventaris(barcodeString);

        // Clear the input field
        event.target.value = "";

    }
}

document.getElementById("barcodeInput").addEventListener("keypress", handleBarcodeInput);
</script>


<?= $this->endSection('dataTables'); ?>