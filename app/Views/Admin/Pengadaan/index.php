<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20 card-box">
                <h5 class="h4 text-blue mb-20">Data Pengadaan</h5>
                <div class="tab-pane fade show active" id="masuk" role="tabpanel">
                    <div class="pd-20">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <!-- <h4 class="text-blue h4">Data ATK</h4> -->
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="<?= base_url('Admin/Pengadaan/Tambah') ?>" class="btn btn-primary">
                                    <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="pb-20 table-responsive">
                            <table class="table hover multiple-select-row nowrap" id="tablePengadaan">
                                <thead>
                                    <tr>
                                        <th class="table-plus">Nama Pemohon</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Keterangan</th>
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
<!-- detail trans keluar -->
<div class="modal fade" id="modalDetailPengadaan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Detail Pengadaan
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
                            <label class="col-sm-4 col-form-label">Tanggal Pengadaan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tanggal_permintaan" name="tangal_permintaan"
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
                            <label class="col-sm-4 col-form-label">Status Pengadaan</label>
                            <div class="col-sm-8">
                                <div id="status"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive pt-4 response">
                            <table class="table table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">Nama ATK</th>
                                        <th scope="col" class="text-center">Spek</th>
                                        <th scope="col" class="text-center">Pemintaan</th>
                                        <th scope="col" class="text-center">Catatan</th>
                                        <th scope="col" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_pengadaan">
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
.response {
    max-height: 400px;
    overflow-y: auto;
}
</style>

<!-- ======================================== END atk ======================================== -->

<?= $this->endSection('content');?>

<?= $this->section('dataTables');?>

<script text="text/javascript">
// dataTables atk
function dataTablesPengadaan() {
    $(document).ready(function() {
        $('#tablePengadaan').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            ajax: "<?php echo base_url('Admin/Pengadaan/DataTables') ?>",
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [{
                    data: 'nama_user'
                },
                {
                    data: 'created_at',
                    class: 'text-center'
                },
                {
                    data: 'ket_pengadaan',
                    class: 'text-center'
                },
                {
                    data: 'status_pengadaan',
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
    dataTablesPengadaan();
});

// edit detail_trans_keluar
$(document).on('click', '.detail_pengadaan', function() {
    const id = $(this).attr('id');
    // alert(id);
    $.ajax({
        url: '<?= base_url('Admin/Pengadaan/edit') ?>',
        type: 'post',
        data: {
            id_pengadaan: id
        },
        dataType: 'json',
        success: function(data) {
            $('#nama_pemohon').val(data.data.nama_user);
            $('#tanggal_permintaan').val(data.data.created_at);
            $('#keterangan').val(data.data.ket_pengadaan);
            $('#status').html(data.data.status_pengadaan == 1 ?
                '<span class="badge badge-warning">Persetujuan</span>' : data.data
                .status_pengadaan == 2 ? '<span class="badge badge-primary">Disetujui</span>' :
                data.data.status_pengadaan == 3 ?
                '<span class="badge badge-info">Proses Pengadaan</span>' : data.data
                .status_pengadaan == 4 ? '<span class="badge badge-success">Selesai</span>' :
                '<span class="badge badge-danger">Ditolak</span>');
            $('#modalDetailPengadaan').modal('show');


            $.ajax({
                url: '<?= base_url('Admin/Pengadaan/fetchPengadaanById') ?>',
                type: 'post',
                data: {
                    id_pengadaan: id
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
                                <td class="text-center">${item.spek}</td>
                                <td class="text-center">${item.qty}</td>
                                <td class="text-center">${item.catatan_detail_pengadaan}</td>
                                <td class="text-center">${item.status_detail_pengadaan == 1 ? '<span class="badge badge-success">Setuju</span>' : item.status_detail_pengadaan == 2 ? '<span class="badge badge-danger">Tolak</span>' : '<span class="badge badge-warning">Proses</span>'}</td>
                               </tr>
                            `;
                        });
                    } else {
                        html += `
                        <tr>
                            <td colspan="6" class="text-center">Data Kosong</td>
                        </tr>
                        `;
                    }
                    $('#tbody_pengadaan').html(html);
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