<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>


<div class="row pb-10">
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-30 text-dark" id="total_antrian"></div>
                    <div class="font-15 text-secondary weight-500">
                        Total Antrean
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#00eccf">
                        <i class="icon-copy fa fa-users" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-30 text-dark" id="antrian_active"></div>
                    <div class="font-15 text-secondary weight-500">
                        Antrean Aktif
                    </div>
                </div>
                <div class="widget-icon" data-color="#09cc06">
                    <div class="icon">
                        <i class="icon-copy fa fa-user-plus" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-30 text-dark" id="sisa_antrian"></div>
                    <div class="font-15 text-secondary weight-500">Antrean tidak aktif</div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#ff5b5b">
                        <i class="icon-copy fa fa-user-times" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-30 text-dark" id="antrian_now"></div>
                    <div class="font-15  text-secondary weight-500">
                        Antrean saat ini
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon">
                        <i class="icon-copy fa fa-user" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="bg-white pd-20 card-box mb-30">
            <h4 class="h4 text-blue">
                Grafik Antrean
            </h4>
            <div id="chart1"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h4 class="text-blue h4">List Antrean Bermasalah</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                    </div>
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row nowrap" id="tableAntrian">
                        <thead>
                            <tr>
                                <th class="table-plus">Nama</th>
                                <th>Kode Regristrasi</th>
                                <th>Jalur</th>
                                <th>Status</th>
                                <th>No antrean</th>
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


<!-- details -->
<div class="modal fade" id="detailsAntrian" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Detail Antrian
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">

                <!-- add image -->
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <img src="" alt="" id="detailqr_code" class="img-thumbnail">
                    </div>
                </div>
                <!-- no antrian -->
                <div class="form-group row m-0">
                    <div class="col-sm-12 text-center">
                        <h2><span id="detailno_antrian" class="header_antrian"></span></h2><br>
                        <h6><span id="detailsesi_antrian"></span></h6>
                    </div>
                    <style>
                        .header_antrian {
                            font-size: 50px;
                            font-weight: bold;
                            font-family: Arial, sans-serif;
                        }
                    </style>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="nama_siswa" class="col-sm-4 col-form-label">Nama Siswa</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="detailnama_siswa" name="nama_siswa"
                            placeholder="Nama" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_pendaftaran" class="col-sm-4 col-form-label">Kode
                        Pendaftaran</label></label>
                    <div class="col-sm-8">
                        <!-- add button cliport -->
                        <input type="text" class="form-control" id="detailkode_pendaftaran" name="kode_pendaftaran"
                            placeholder="Kode Pendaftaran" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nisn" class="col-sm-4 col-form-label">Nisn</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="detailnisn" name="nisn" placeholder="NISN" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="detailjenis_kelamin" name="jenis_kelamin"
                            placeholder="Jenis Kelamin" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="asal_sekolah" class="col-sm-4 col-form-label">Asal Sekolah</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="detailasal_sekolah" name="asal_sekolah"
                            placeholder="Asal Sekolah" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_tlp" class="col-sm-4 col-form-label">No telpon</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="detailno_tlp" name="no_tlp" placeholder="No telpon"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label">alamat</label></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="detailalamat" name="alamat" placeholder="Alamat"
                            readonly></textarea>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="jalur_pendaftaran" class="col-sm-4 col-form-label">Jalur
                        Pendaftaran</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="detailjalur_pendaftaran" name="jalur_pendaftaran"
                            placeholder="Jalur Pendaftaran" readonly>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="tanggal_antrian" class="col-sm-4 col-form-label">Tanggal Lahir</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="detailtanggal_antrian" name="tanggal_antrian"
                            placeholder="Tanggal Lahir" readonly>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="ket_antrian" class="col-sm-4 col-form-label">Ket Antrian</label></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="detailket_antrian" name="ket_antrian"
                            placeholder="Ket Antrian" readonly>
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

<?= $this->endSection('content'); ?>

<?= $this->section('dataTables'); ?>

<script text="text/javascript">
    // dataTables users
    function dataTablesAntrian() {
        $(document).ready(function() {
            $('#tableAntrian').DataTable({
                processing: true,
                serverSide: true,
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                ajax: "<?php echo base_url('Admin/Antrian/AjaxAntrianNotActive') ?>",
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                columns: [{
                        data: 'nama_siswa',
                        class: 'table-plus'
                    },
                    {
                        data: 'kode_pendaftaran'
                    },
                    {
                        data: 'jalur_pendaftaran'
                    },
                    {
                        data: 'status_antrian',
                    },
                    {
                        data: 'no_antrian',
                    },
                    {
                        data: 'action',
                        class: 'datatable-nosort'
                    },

                ],
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
            });
        });
    }
    dataTablesAntrian();


    function getSwall(status, message) {
        swal({
            title: message,
            type: status == '200' ? 'success' : 'error',
            showCancelButton: false,
            showConfirmButton: true,
            timer: 1500

        })
    }


    const listFields = ['nama_siswa', 'nisn', 'jenis_kelamin', 'kode_pendaftaran', 'asal_sekolah', 'no_tlp',
        'alamat',
        'jalur_pendaftaran', 'tanggal_antrian', 'ket_antrian'
    ];


    function fetchAntrian() {
        $.ajax({
            url: '<?= base_url('Admin/Antrian/getResultAntrean') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error == false) {
                    $('#total_antrian').html(response.data.total_antrean);
                    $('#antrian_active').html(response.data.total_antrean);
                    $('#antrian_now').html(response.data.total_antrean);
                    $('#sisa_antrian').html(response.data.total_antrean);
                }
            }
        });
    }

    setInterval(function() {
        fetchAntrian();
    }, 1000);

    // details user
    $(document).on('click', '.detailsAntrian', function() {
        var id = $(this).attr('id');
        $.ajax({
            url: '<?= base_url('Admin/Antrian/edit') ?>',
            method: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $('#detailsAntrian').modal('show');
                listFields.forEach(function(item) {
                    $("#detail" + item).val(response.data[item]);
                });
                $("#detailqr_code").attr('src', '<?= base_url('Assets/qr_code/') ?>' + response
                    .data
                    .qr_code);
                $("#detailno_antrian").html(response.data.no_antrian);
                $("#detailsesi_antrian").html(response.data.sesi_antrian);
            }
        });
    });;

    // chart
    function getChartAntrean() {
        let data = [];
        let tanggal = [];
        $.ajax({
            url: '<?= base_url('Admin/Antrian/getStatistic') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error == false) {
                    // alert(response.data);
                    for (let i = 0; i < response.data.length; i++) {
                        dataArray = [
                            response.data[i].total,
                            response.data[i].gagal,
                            response.data[i].sukses
                        ];
                        // console.log(dataArray);
                        data.push(dataArray);
                        tanggal.push(response.data[i].tanggal);
                    }
                }
                console.log(data);
                console.log(tanggal);
            }
        });

        var options3 = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 80, 89, 90, 100, 20]
            }, {
                name: 'Revenue',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 80, 89, 90, 100, 20]
            }, {
                name: 'Free Cash Flow',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 80, 89, 90, 100, 20]
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false,
                }
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
            xaxis: {
                categories: ['11 Jun', '12 Jun', '13 Jun', '14 Jun', '15 Jun', '16 Jun', '17 Jun', '18 Jun', '19 Jun',
                    '20 Jun', '21 Jun', '22 Jun', '23 Jun', '24 Jun'
                ],
            },
            yaxis: {
                title: {
                    text: '$(thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$" + val + "thousands"
                    }
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart1"), options3);
        chart.render();
    }
    getChartAntrean();
</script>

<?= $this->endSection('dataTables'); ?>s