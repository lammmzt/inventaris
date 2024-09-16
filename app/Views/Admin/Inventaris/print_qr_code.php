<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak QR Code</title>
</head>

<body>
    <!-- parse data qr_code to 1 files -->
    <?php for ($i = 0; $i < count($data_inventaris); $i++) : ?>
    <!-- <div class="container"> -->
    <div class="print-container">
        <img src="<?= base_url('Assets/qr_code/' . $data_inventaris[$i]) ?>" alt="qr_code" class="qr_code">
    </div>
    <!-- </div> -->
    <?php endfor; ?>

    <style>
    .print-container {
        width: 200px;
        height: 200px;
        display: inline-block;
        margin: 5px;
    }

    .qr_code {
        width: 100%;
        height: 100%;
    }

    @media print {
        .print-container {
            width: 200px;
            height: 200px;
            display: inline-block;
            margin: 5px;
        }

        .qr_code {
            width: 100%;
            height: 100%;
        }
    }

    @page {
        size: A4;
        margin: 0;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
        }
    }
    </style>

    <script>
    // auto download the file to pdf
    window.print();
    </script>
</body>

</html>