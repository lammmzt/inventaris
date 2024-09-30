<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>


<div class="row pb-10">
    <div class="col-md-12 mb-4">
        <div class="row">
            <div class="col-md-6">
                <h4 class="">Welcome, <?= session()->get('username'); ?></h4>
                <p class="text_date">Today is <?= date('l, d F Y'); ?></p>
            </div>
            <div class="col-md-6 text-right">
                <h6 class="" id="clock"></h6>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">Data Transaksi</h4>
                    </div>
                    <!-- <div class="col-sm-6 text-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addBarang" type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div> -->
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tabelTransaksi">
                        <thead>
                            <tr>
                                <th class="table-plus">Nama Pemohon</th>
                                <th class="">Jenis</th>
                                <th class="">Tanggal</th>
                                <th class="">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">Data Kondisi Inventaris</h4>
                    </div>
                    <!-- <div class="col-sm-6 text-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addBarang" type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div> -->
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tabelKondisi">
                        <thead>
                            <tr>
                                <th class="table-plus">Nama Pelapor</th>
                                <th class="">Nama Barang</th>
                                <th class="">Tanggal</th>
                                <th class="">Ruangan</th>
                                <th class="">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text_date {
    font-size: 14px;
    color: #6c757d;
}
</style>

<?= $this->endSection('content'); ?>

<?= $this->section('dataTables'); ?>

<script text="text/javascript">
// Clock
function showTime() {
    // jam indonesia
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";

    if (h == 0) {
        h = 12;
    }

    if (h > 12) {
        h = h - 12;
        session = "PM";
    }

    h = (h < 10) ? "0" + h : h;

    m = (m < 10) ? "0" + m : m;

    s = (s < 10) ? "0" + s : s;

    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("clock").innerText = time;
    document.getElementById("clock").textContent = time;

    setTimeout(showTime, 1000);

}

showTime();

// Datatables transaksi
function dataTablesTransaksi() {
    $(document).ready(function() {
        $('#tabelTransaksi').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('getAllDataTras') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_user',
                    name: 'nama_user'
                },
                {
                    data: 'tipe_transaksi',
                    name: 'tipe_transaksi'
                },
                {
                    data: 'tanggal_transaksi',
                    name: 'tanggal_transaksi'
                },
                {
                    data: 'status_transaksi',
                    name: 'status_transaksi'
                },

            ],
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            order: [
                [1, 'desc']
            ],
        });
    });
}

dataTablesTransaksi();

// Datatables kondisi
function dataTablesKondisi() {
    $(document).ready(function() {
        $('#tabelKondisi').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('getAllDataTPengecekan') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_user',
                    name: 'nama_user'
                },
                {
                    data: 'nama_inventaris',
                    name: 'nama_inventaris'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'nama_ruangan',
                    name: 'nama_ruangan'
                },
                {
                    data: 'status_pengecekan',
                    name: 'status_pengecekan'
                },

            ],
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            order: [
                [1, 'desc']
            ],
        });
    });
}

dataTablesKondisi();
</script>

<?= $this->endSection('dataTables'); ?>s