<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>
        <?= $title; ?>
    </title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('Assets/'); ?>LOGO SMANSA.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('Assets/'); ?>LOGO SMANSA.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('Assets/'); ?>LOGO SMANSA.png" />
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />


    <!-- dataTables -->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('Assets/'); ?>src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('Assets/'); ?>src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/'); ?>vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/'); ?>vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/'); ?>src/plugins/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/'); ?>vendors/styles/style.css" />


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
        crossorigin="anonymous"></script>

    <style>

    </style>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            "gtm.start": new Date().getTime(),
            event: "gtm.js"
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != "dataLayer" ? "&l=" + l : "";
        j.async = true;
        j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->

    <style>
    .rq {
        color: red;
    }

    .footer {
        position: relative;
        bottom: 0;
        width: 100%;
        color: #333;
        padding: 10px 0;
    }

    @media (max-width: 764px) {
        .footer {
            text-align: center;
        }
    }
    </style>
</head>

<body class="sidebar-light">
    <!-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="vendors/images/deskapp-logo.svg" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div> -->

    <!-- include the header -->
    <?= $this->include('Layout/header'); ?>

    <!-- include the sidebar -->
    <?= $this->include('Layout/sidebar'); ?>


    <!-- main contetn -->
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- include the breadcrumb -->
                <?php
                if ($active != 'Dashboard') :
                ?>
                <?= $this->include('Layout/breadcrumb'); ?>
                <?php endif; ?>

                <!-- render the section -->
                <?= $this->renderSection('content'); ?>
            </div>

            <!-- include the footer -->
            <?= $this->include('Layout/footer'); ?>
        </div>
    </div>
    <!-- endContent -->


    <!-- js -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"
        integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url('Assets/'); ?>vendors/scripts/core.js"></script>
    <script src="<?= base_url('Assets/'); ?>vendors/scripts/script.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>vendors/scripts/process.js"></script>
    <script src="<?= base_url('Assets/'); ?>vendors/scripts/layout-settings.js"></script>

    <script src="<?= base_url('Assets/'); ?>src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>vendors/scripts/dashboard3.js"></script>
    <!-- <script src="<?= base_url('Assets/'); ?>vendors/scripts/dashboard.js"></script> -->
    <!-- buttons for Export datatable -->
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/jszip.min.js"></script>
    <script src="<?= base_url('Assets/'); ?>src/plugins/datatables/js/vfs_fonts.js"></script>

    <!-- Datatable Setting js -->
    <?= $this->renderSection('dataTables'); ?>

    <script src="<?= base_url('Assets/'); ?>src/plugins/sweetalert2/sweetalert2.all.js"></script>

    <script type="text/javascript">
    $(document).on('focusout', '.required', function() {
        const id = $(this).attr('id');
        if ($(this).val() == '') {
            $(this).addClass('form-control-danger');
            $(`#error${id}`).html('Field ini tidak boleh kosong');
            $(`#error${id}`).addClass('has-danger');
        } else {
            $(this).addClass('form-control-success');
            $(this).removeClass('form-control-danger');
            $(`#error${id}`).html('');
            $(`#error${id}`).removeClass('has-danger');
        }
    });

    $(document).on('keyup', '.required', function() {
        const id = $(this).attr('id');
        if ($(this).val() != '') {
            $(this).removeClass('form-control-danger');
            $(this).addClass('form-control-success');
            $(`#error${id}`).html('');
            $(`#error${id}`).removeClass('has-danger');
        } else {
            $(this).addClass('form-control-danger');
            $(`#error${id}`).html('Field ini tidak boleh kosong');
            $(`#error${id}`).addClass('has-danger');
        }
    });
    </script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>