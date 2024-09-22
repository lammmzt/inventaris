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
                                        <option value="">Semua Transasksi</option>
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
                    <table class="table hover multiple-select-row nowrap" id="laporanTransaksi">
                        <thead>
                            <th class="table-plus">Tanggal</th>
                            <th>Status</th>
                            <th>Nama Pemohon</th>
                            <th>Keperluan</th>
                            <th style="min-width: 200px;">Detail Barang</th>
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
function laporanAntrean() {
    $(document).ready(function() {

        $('#laporanTransaksi').DataTable({
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
                    className: 'text-center',
                },
                {
                    data: 'nama_user'
                },
                {
                    data: 'ket_transaksi'
                },
                {
                    data: 'detail_transaksi'
                }

            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    title: 'Data Antrian',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'excel',
                    title: 'Data Antrian',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    title: 'Data Antrian',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'csv',
                    title: 'Data Antrian',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
            ]
        });

    });
}

laporanAntrean();

$('#btn-reset').on('click', function() {
    $('#tgl_awal').val('');
    $('#tgl_akhir').val('');
    $('#status_antrian').val('');
    $('#jenis_transaksi').DataTable().ajax.reload();
});

$('#btn-filter').on('click', function() {
    // $('#btn-filter').html(
    //     '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
    // );
    $('#laporanTransaksi').DataTable().ajax.reload();
});
</script>

<?= $this->endSection('dataTables');?>s