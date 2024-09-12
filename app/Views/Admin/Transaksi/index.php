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
                                                <th class="table-plus">Nama User</th>
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
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addatk"
                                            type="button">
                                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="pb-20 table-responsive">
                                    <table class="table hover multiple-select-row nowrap" id="tabelTransaksiKeluar">
                                        <thead>
                                            <tr>
                                                <th class="table-plus">Nama User</th>
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
                    data: 'tanggal_transaksi'
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
                    data: 'tanggal_transaksi'
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

// ketika modal tambah atk muncul
$('#addatk').on('shown.bs.modal', function() {
    getTipeBarang();
    getSatuan();
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

// ======================================== atk ========================================
</script>

<!-- switchery js -->
<script src="<?= base_url('Assets/'); ?>src/plugins/switchery/switchery.min.js"></script>
<script src="<?= base_url('Assets/'); ?>vendors/scripts/advanced-components.js"></script>
<?= $this->endSection('dataTables');?>