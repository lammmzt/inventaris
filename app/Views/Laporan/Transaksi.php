<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">Data Transaksi</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <!-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addAntrian" type="button">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        </a> -->
                    </div>
                </div>
                <form id="form_laporan">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-12 col-md-12 col-form-label">Tanggal Awal</label>
                                <div class="col-sm-12 col-md-12">
                                    <input class="form-control" type="date" id="tgl_awal" name="tgl_awal">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-12 col-md-12 col-form-label">Tanggal Akhir</label>
                                <div class="col-sm-12 col-md-12">
                                    <input class="form-control" type="date" id="tgl_akhir" name="tgl_akhir">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-12 col-md-12 col-form-label">Jenis Transaksi</label>
                                <div class="col-sm-12 col-md-12">
                                    <select class="custom-select col-12" id="jenis_transaksi" name="jenis_transaksi">
                                        <option value="">Semua Transaksi</option>
                                        <option value="0" id="status0">Masuk</option>
                                        <option value="1" id="status1">Keluar</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mt-4 text-center">
                                <button class="btn btn-primary" id="btn-filter" type="button">
                                    <i class="icon-copy fa fa-search" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn-secondary" id="btn-reset" type="button">
                                    <i class="icon-copy fa fa-refresh" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tabelTransaksi">
                        <thead>
                            <th class="table-plus">Tanggal</th>
                            <th>Jenis Transaksi</th>
                            <th>Nama Pemohon</th>
                            <th>Keperluan</th>
                            <th style="min-width: 200px;" class="datatable-nosort">Detail Barang</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.detail_trans {
    margin-bottom: 0;
}
</style>


<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>


<script text="text/javascript">
// dataTables Laporan Antrean
function laporanTransaksi() {
    $(document).ready(function() {
        $('#tabelTransaksi').DataTable({
            processing: true,
            serverSide: true,
            // responsive: true,
            ajax: {
                url: '<?= base_url('Admin/Laporan/ajaxLaporanTransaksi') ?>',
                type: 'POST',
                data: function(data) {
                    data.tgl_awal = $('#tgl_awal').val();
                    data.tgl_akhir = $('#tgl_akhir').val();
                    data.jenis_transaksi = $('#jenis_transaksi').val();
                }
            },
            columns: [{
                    data: 'tanggal_transaksi'
                },
                {
                    data: 'tipe_transaksi',
                    class: 'text-center',
                },
                {
                    data: 'nama_user'
                },
                {
                    data: 'ket_transaksi'
                },
                {
                    data: 'detail_transaksi',
                    class: 'datatable-nosort'
                }

            ],
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            order: [
                [0, 'asc']
            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    title: '',
                    messageTop: '<img src="<?= base_url('Assets/kop surat 2.png') ?>" style="width: 100%;"> <br> <h3 class="text-center text-black" style="margin-top: 20px; margin-bottom: 20px; color: black;">Laporan Transaksi</h3>',
                    className: 'btn btn-primary',
                    messageBottom: '<table class="footers" style="width: 100%; margin-top: 40px;"><tr><td style="width: 50%;"></td><td style="width: 50%; text-align: center; margin-bottom: 5px">Pekalongan, .............................. <br>Yang Membuat<br><br><br><br></br><br>(...........................................)</td></tr></table>',
                    customize: function(win) {
                        $(win.document.body).find('table thead tr th').css({
                            'font-size': '12px',
                            'text-align': 'center',
                            'font-weight': 'bold',
                            'background-color': '#D3D3D3',
                            'color': 'black',
                            'border': '1px solid black'
                        });
                        $(win.document.body).find('table tbody tr td').css({
                            'font-size': '12px',
                            'text-align': 'center',
                            'border': '1px solid black'
                        });

                        $(win.document.body).find('table.footers tr td').css({
                            'border': '0',
                            'padding': '0px',
                            'color': 'black',
                            'margin': '0px',
                            'font-size': '12px',
                            'text-align': 'center',
                        });
                    },
                },
                {
                    extend: 'excel',
                    title: 'Data Transaksi',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                // {
                //     extend: 'pdf',
                //     title: 'Data Antrian',
                //     className: 'btn btn-primary',
                //     exportOptions: {
                //         columns: [0, 1, 2, 3, 4]
                //     }
                // },
                // {
                //     extend: 'csv',
                //     title: 'Data Antrian',
                //     className: 'btn btn-primary',
                //     exportOptions: {
                //         columns: [0, 1, 2, 3, 4]
                //     }
                // }
            ]
        });

    });
}

laporanTransaksi();

var tgl_awal = $('#tgl_awal').val();
var tgl_akhir = $('#tgl_akhir').val();

$('#btn-reset').on('click', function() {
    $('#tgl_awal').val('');
    $('#tgl_akhir').val('');
    $('#status_antrian').val('');
    $('#tabelTransaksi').DataTable().ajax.reload();
    tgl_awal = $('#tgl_awal').val();
    tgl_akhir = $('#tgl_akhir').val();
});

$('#btn-filter').on('click', function() {
    // $('#btn-filter').html(
    //     '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
    // );
    tgl_awal = $('#tgl_awal').val();
    tgl_akhir = $('#tgl_akhir').val();
    $('#tabelTransaksi').DataTable().ajax.reload();
});
</script>

<?= $this->endSection('dataTables');?>s