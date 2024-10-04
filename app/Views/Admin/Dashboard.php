<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>


<div class="row pb-10">
    <div class="col-md-12 mb-4">
        <div class="row">
            <div class="col-md-6">
                <h4 class="">Welcome, <?= session()->get('nama_user'); ?></h4>
                <p class="text_date">Today is <?= date('l, d F Y'); ?></p>
            </div>
            <div class="col-md-6 text-right">
                <h6 class="" id="clock"></h6>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4 table-responsive">
        <div class="card-box height-100-p pd-20">
            <h2 class="h4 mb-20">Transaksi ATK Tahun <?= date('Y'); ?></h2>
            <div id="chart5"></div>
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
                        <h4 class="text-blue h4">Data Pengadaan Inventaris</h4>
                    </div>
                    <!-- <div class="col-sm-6 text-right">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addBarang" type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div> -->
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tabelPengadaan">
                        <thead>
                            <tr>
                                <th class="table-plus">Nama Pemohon</th>
                                <th class="">Ket</th>
                                <th class="">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
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
            ajax: "<?php echo base_url('getAllDataPengecekan') ?>",
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

// Datatables pengadaan
function dataTablesPengadaan() {
    $(document).ready(function() {
        $('#tabelPengadaan').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('DataTablesGetAllPengadaan') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_user',
                    name: 'nama_user'
                },
                {
                    data: 'ket_pengadaan',
                    name: 'ket_pengadaan'
                },
                {
                    data: 'status_pengadaan',
                    name: 'status_pengadaan'
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

dataTablesPengadaan();

// get data transaksi
function getAllDataTransInYear() {
    $.ajax({
        url: "<?= base_url('getAllDataTransInYear') ?>",
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (response.error == false) {
                var data = response.data;
                var qty_masuk = [];
                var qty_keluar = [];
                var mount = [];
                data.forEach(function(item) {
                    qty_masuk.push(item.qty_masuk);
                    qty_keluar.push(item.qty_keluar);
                    // inisialisasi bulan JAN - DEC
                    var month = '';
                    if (item.mount == 1) {
                        month = 'Jan';
                    } else if (item.mount == 2) {
                        month = 'Feb';
                    } else if (item.mount == 3) {
                        month = 'Mar';
                    } else if (item.mount == 4) {
                        month = 'Apr';
                    } else if (item.mount == 5) {
                        month = 'May';
                    } else if (item.mount == 6) {
                        month = 'Jun';
                    } else if (item.mount == 7) {
                        month = 'Jul';
                    } else if (item.mount == 8) {
                        month = 'Aug';
                    } else if (item.mount == 9) {
                        month = 'Sep';
                    } else if (item.mount == 10) {
                        month = 'Oct';
                    } else if (item.mount == 11) {
                        month = 'Nov';
                    } else if (item.mount == 12) {
                        month = 'Dec';
                    }
                    mount.push(month);
                });

                chart5.updateSeries([{
                    data: qty_masuk
                }, {
                    data: qty_keluar
                }]);
                chart5.updateOptions({
                    xaxis: {
                        categories: mount
                    }
                });
            } else {
                alert('Error');
                console.log(response.data);
            }
        }
    });
}

getAllDataTransInYear();
// chart
var options5 = {
    chart: {
        height: 350,
        type: 'bar',
        parentHeightOffset: 0,
        fontFamily: 'Poppins, sans-serif',
        toolbar: {
            show: false,
        },
    },
    colors: ['#1b00ff', '#f56767'],
    grid: {
        borderColor: '#c7d2dd',
        strokeDashArray: 5,
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '25%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    series: [{
        name: 'ATK Masuk',
        data: []
    }, {
        name: 'ATK Keluar',
        data: []
    }],
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        labels: {
            style: {
                colors: ['#353535'],
                fontSize: '16px',
            },
        },
        axisBorder: {
            color: '#8fa6bc',
        }
    },
    yaxis: {
        title: {
            text: ''
        },
        labels: {
            style: {
                colors: '#353535',
                fontSize: '16px',
            },
        },
        axisBorder: {
            color: '#f00',
        }
    },
    legend: {
        horizontalAlign: 'right',
        position: 'top',
        fontSize: '16px',
        offsetY: 0,
        labels: {
            colors: '#353535',
        },
        markers: {
            width: 10,
            height: 10,
            radius: 15,
        },
        itemMargin: {
            vertical: 0
        },
    },
    fill: {
        opacity: 1

    },
    tooltip: {
        style: {
            fontSize: '15px',
            fontFamily: 'Poppins, sans-serif',
        },
        y: {
            formatter: function(val) {
                return val
            }
        }
    }
}
var chart5 = new ApexCharts(document.querySelector("#chart5"), options5);
chart5.render();
</script>

<?= $this->endSection('dataTables'); ?>s