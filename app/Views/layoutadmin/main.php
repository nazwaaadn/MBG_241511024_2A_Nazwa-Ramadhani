<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url('Admin/css/styles.css') ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .body {
                font-family: 'Poppins', sans-serif;
            }
            .custom-card {
            box-shadow: 0 4px 18px rgba(0, 0, 255, 0.1);
            border-radius: 12px;
            margin-bottom: 20px;
            }
            .custom-card h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
            }
            .form-card {
            padding: 40px;
            }
            .outer-container {
            padding: 40px; /* jarak luar antara card dan tepi layar/container */
            }
        </style>
</head>
<body class="sb-nav-fixed">
    <!-- Navbar -->
    <?= $this->include('layoutAdmin/navbar') ?>

    <div id="layoutSidenav">
        <!-- Sidebar -->
        <?= $this->include('layoutAdmin/sidebar') ?>

        <!-- Konten Utama -->
        <div id="layoutSidenav_content">
            <?= $content ?>

            <!-- Footer -->
            <?= $this->include('layoutAdmin/footer') ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="<?= base_url('Admin/js/scripts.js') ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('Admin/assets/demo/chart-area-demo.js') ?>"></script>
    <script src="<?= base_url('Admin/assets/demo/chart-bar-demo.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('Admin/js/datatables-simple-demo.js') ?>"></script>

    

</body>
</html>
