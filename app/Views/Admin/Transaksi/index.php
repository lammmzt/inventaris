<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20 card-box">
                <h5 class="h4 text-blue mb-20">Data Transaksi</h5>
                <div class="tab">
                    <!-- 2 tab dengan lebar full width ditengah -->
                    <ul class="nav nav-tabs customtab nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#masuk" role="tab"
                                aria-selected="true">MASUK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#keluar" role="tab"
                                aria-selected="false">KELUAR</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="masuk" role="tabpanel">
                            <div class="pd-20">
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <!-- <h4 class="text-blue h4">Data ATK</h4> -->
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a href="<?= base_url('Admin/ATK/Transaksi/Masuk') ?>" class="btn btn-primary">
                                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="pb-20 table-responsive">
                                    <table class="table hover multiple-select-row nowrap" id="tabelTransaksiMasuk">
                                        <thead>
                                            <tr>
                                                <th class="table-plus">Nama Pengguna</th>
                                                <th class="table-plus">Tanggal</th>
                                                <th class="">Status</th>
                                                <th class="datatable-nosort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="keluar" role="tabpanel">
                            <div class="pd-20">
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <!-- <h4 class="text-blue h4">Data ATK</h4> -->
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a href="<?= base_url('Admin/ATK/Transaksi/Keluar') ?>" class="btn btn-primary">
                                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="pb-20 table-responsive">
                                    <table class="table hover multiple-select-row nowrap" id="tabelTransaksiKeluar">
                                        <thead>
                                            <tr>
                                                <th class="table-plus">Nama Pemohon</th>
                                                <th class="table-plus">Tanggal</th>
                                                <th class="">Status</th>
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
            </div>
        </div>
    </div>
</div>

<!-- detail trans keluar -->
<div class="modal fade" id="modalDetailTransMasuk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Detail Transaksi Masuk
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Pemohon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Transaksi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="keterangan" name="keterangan" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <div id="status"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive pt-4">
                            <table class="table table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">Nama ATK</th>
                                        <th scope="col" class="text-center">QTY</th>
                                        <th scope="col" class="text-center">Catatan</th>
                                        <th scope="col" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_transaksi_masuk">
                                    <tr>
                                        <td colspan="5" class="text-center">Data Kosong</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- detail trans keluar -->
<div class="modal fade" id="modalDetailTransKeluar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Detail Transaksi Keluar
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Pemohon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_pemohon_keluar"
                                    name="nama_pemohon_keluar" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Transaksi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tanggal_transaksi_keluar"
                                    name="tanggal_transaksi" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="keterangan_keluar" name="keterangan"
                                    readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <div id="status_keluar"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive pt-4">
                            <table class="table table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">Nama ATK</th>
                                        <th scope="col" class="text-center">QTY</th>
                                        <th scope="col" class="text-center">Catatan</th>
                                        <th scope="col" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_transaksi">
                                    <tr>
                                        <td colspan="5" class="text-center">Data Kosong</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Tutup
                </button>
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

<!-- ======================================== END atk ======================================== -->

<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// dataTables atk
function dataTablesTransMasuk() {
    $(document).ready(function() {
        $('#tabelTransaksiMasuk').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/ATK/Transaksi/DataTablesMasuk') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_user'
                },
                {
                    data: 'tanggal_transaksi',
                    class: 'text-center'
                },
                {
                    data: 'status_transaksi',
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

// datatables transaksi keluar
function dataTablesTransKeluar() {
    $(document).ready(function() {
        $('#tabelTransaksiKeluar').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/ATK/Transaksi/DataTablesKeluar') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_user'
                },
                {
                    data: 'tanggal_transaksi',
                    class: 'text-center'
                },
                {
                    data: 'status_transaksi',
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
    dataTablesTransMasuk();
    dataTablesTransKeluar();
});

// edit detail_trans_masuk
$(document).on('click', '.detail_trans_masuk', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/ATK/Transaksi/edit') ?>',
        type: 'post',
        data: {
            id_transaksi: id
        },
        dataType: 'json',
        success: function(data) {
            // console.log(data);
            $('#nama_pemohon').val(data.data.nama_user);
            $('#tanggal_transaksi').val(data.data.tanggal_transaksi);
            $('#keterangan').val(data.data.ket_transaksi);
            $('#status').html(data.data.status_transaksi == 1 ?
                '<span class="badge badge-success">Selesai</span>' :
                '<span class="badge badge-warning">Proses</span>');
            $('#modalDetailTransMasuk').modal('show');


            $.ajax({
                url: '<?= base_url('Admin/ATK/Transaksi/fetchDetailTransByIdTrans') ?>',
                type: 'post',
                data: {
                    id_transaksi: id
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    let html = '';
                    if (data.data.length > 0) {
                        data.data.forEach((item, index) => {
                            html += `
                            <tr>
                                <td class="text-center">${index+1}</td>
                                <td>${item.nama_barang + ' - ' + item.nama_tipe_barang + '(' + item.merek_atk + ') @ ' + item.nama_satuan}</td>
                                <td class="text-center">${item.qty}</td>
                                <td class="text-center">${item.catatan_detail_transaksi}</td>
                                <td class="text-center">${item.status_detail_transaksi == 1 ? '<span class="badge badge-success">Setuju</span>' : '<span class="badge badge-danger">Tolak</span>'}</td>
                            </tr>
                            `;
                        });
                    } else {
                        html += `
                        <tr>
                            <td colspan="5" class="text-center">Data Kosong</td>
                        </tr>
                        `;
                    }
                    $('#tbody_transaksi_masuk').html(html);
                }

            });
        }

    });
});

// edit detail_trans_keluar
$(document).on('click', '.detail_trans_keluar', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/ATK/Transaksi/edit') ?>',
        type: 'post',
        data: {
            id_transaksi: id
        },
        dataType: 'json',
        success: function(data) {
            // console.log(data);
            $('#nama_pemohon_keluar').val(data.data.nama_user);
            $('#tanggal_transaksi_keluar').val(data.data.tanggal_transaksi);
            $('#keterangan_keluar').val(data.data.ket_transaksi);
            $('#status_keluar').html(data.data.status_transaksi == 1 ?
                '<span class="badge badge-success">Selesai</span>' :
                '<span class="badge badge-warning">Proses</span>');
            $('#modalDetailTransKeluar').modal('show');


            $.ajax({
                url: '<?= base_url('Admin/ATK/Transaksi/fetchDetailTransByIdTrans') ?>',
                type: 'post',
                data: {
                    id_transaksi: id
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    let html = '';
                    if (data.data.length > 0) {
                        data.data.forEach((item, index) => {
                            html += `
                            <tr>
                                <td class="text-center">${index+1}</td>
                                <td>${item.nama_barang + ' - ' + item.nama_tipe_barang + '(' + item.merek_atk + ') @ ' + item.nama_satuan}</td>
                                <td class="text-center">${item.qty}</td>
                                <td class="text-center">${item.catatan_detail_transaksi}</td>
                                <td class="text-center">${item.status_detail_transaksi == 1 ? '<span class="badge badge-success">Setuju</span>' : '<span class="badge badge-danger">Tolak</span>'}</td>
                            </tr>
                            `;
                        });
                    } else {
                        html += `
                        <tr>
                            <td colspan="5" class="text-center">Data Kosong</td>
                        </tr>
                        `;
                    }
                    $('#tbody_transaksi').html(html);
                }

            });
        }

    });
});

// ======================================== atk ========================================
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>