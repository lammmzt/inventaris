<?= $this->extend('Templates/index'); ?>
<?= $this->section('content'); ?>


<div class="row pb-10">
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-30 text-dark" id="total_antrian"></div>
                    <div class="font-15 text-secondary weight-500">
                        Total barang
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
                        barang Aktif
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
                    <div class="font-15 text-secondary weight-500">barang tidak aktif</div>
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
                        barang saat ini
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
                Grafik barang
            </h4>
            <div id="chart1"></div>
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
        url: '<?= base_url('Admin/Antrian/getResultbarang') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.error == false) {
                $('#total_antrian').html(response.data.total_barang);
                $('#antrian_active').html(response.data.total_barang);
                $('#antrian_now').html(response.data.total_barang);
                $('#sisa_antrian').html(response.data.total_barang);
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
function getChartbarang() {
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
getChartbarang();
</script>

<?= $this->endSection('dataTables'); ?>s