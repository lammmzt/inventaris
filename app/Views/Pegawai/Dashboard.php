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
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modalDetail -->
<div class="modal fade" id="detail_kondisi" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Detail Pelaporan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <form id="form_tambah_pelaporan" enctype="multipart/form-data">
                <!-- <form action="<?= base_url('Admin/Inventaris/Pelaporan/save') ?>" method="post"
                enctype="multipart/form-data"> -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <h4 class="text-blue h4 text-center">Histori Pelaporan</h4>
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
                            Close
                        </button>
                    </div>
                </div>
            </form>
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
            ajax: "<?php echo base_url('DataTablesDashboardTrans') ?>",
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
                {
                    data: 'action',
                    name: 'action'
                }

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


// get data 
function getDataInventaris(id) {
    $.ajax({
        url: '<?= base_url('Admin/Inventaris/fetchInventarisByKodeInventaris') ?>',
        method: 'post',
        data: {
            id_inventaris: id
        },
        success: function(response) {
            if (response.status == '200') {
                $('#detail_kondisi').modal('show');
                if (response.data.pelaporan.length > 0) {
                    $('#table_history_pengecekan tbody').empty();
                    $.each(response.data.pelaporan, function(index, value) {
                        $('#table_history_pengecekan tbody').append(
                            '<tr>' +
                            '<td class="text-center">' + (index + 1) + '</td>' +
                            '<td>' + value.nama_user + '</td>' +
                            '<td class="text-center">' + value.created_at + '</td>' +
                            '<td class="text-center">' + value.ket_pengecekan + '</td>' +
                            '<td class="text-center">' + (value.foto_pengecekan == '' ?
                                'Tidak ada foto' :
                                '<a href="<?= base_url('Assets/uploads/pengecekan/') ?>' +
                                value.foto_pengecekan +
                                '" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>' +
                                '</td>') +
                            '<td class="text-center">' +
                            (value.status_pengecekan ==
                                '1' ?
                                '<span class="badge badge-success">Baik</span>' :
                                value.status_pengecekan == '2' ?
                                '<span class="badge badge-warning">Rusak</span>' :
                                value.status_pengecekan == '3' ?
                                '<span class="badge badge-info">Perbaikan</span>' :
                                '<span class="badge badge-danger">Hilang</span>') +

                            '</td>' +
                            '</tr>'
                        );
                    });
                } else {
                    $('#table_history_pengecekan tbody').empty();
                    $('#table_history_pengecekan tbody').append(
                        '<tr>' +
                        '<td colspan="6" class="text-center">Tidak ada data</td>' +
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

// when click button detail
$(document).on('click', '.detail_perbaikan', function() {
    const id = $(this).attr('id');
    // alert(id);
    getDataInventaris(id);
});
</script>

<?= $this->endSection('dataTables'); ?>s