<?php

include '../../action/connection/koneksi.php';
include '../../action/function.php';

if (isset($_SESSION['isLoginUser'])) {
    $user = $_SESSION['user'];
    if ($user['level'] != 'user') {
        $_SESSION['invalidAkses'] = true;
        $_SESSION['pesan'] = showAlert('warning', 'Anda Tidak Memiliki Hak Akses');
        header('location:../../index.php');
    }
} else {
    $_SESSION['validLogin'] = false;
    $_SESSION['pesan'] = showAlert('danger', 'Harap Login Terlebih Dulu');
    header('location:../../action/auth/login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Laundri App - User Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama'] ?></span>
                                <img class="img-profile rounded-circle" src="../../assets/img/undraw_profile.svg" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile/viewProfile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Tambah Pesanan</h1>

                    <div class="card shadow my-3 col-lg-11">
                        <div class="card-body">

                            <a href="../../index.php" class="mb-3 btn btn-primary btn-circle btn-lg">
                                <i class="fas fa-angle-left fa-lg"></i>
                            </a>

                            <form action="../../action/function.php" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group w-75">
                                            <label for="">Username</label>
                                            <input type="text" readonly value="<?= $user['username'] ?>" name="username" class="form-control" placeholder="Username Customer">
                                        </div>
                                        <div class="form-group w-75">
                                            <label for="">Telepon</label>
                                            <input type="tel" name="telepon" value="<?= $user['telepon'] ?>" class="form-control" placeholder="08xx-xxxx-xxxx">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group w-75">
                                            <label for="">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" placeholder="Alamat...">
                                        </div>
                                        <div class="form-group w-75">
                                            <label for="">Paket</label>

                                            <select class="custom-select mr-sm-2" name="paket" id="inlineFormCustomSelect">
                                                <option selected disabled>Pilih Paket...</option>
                                                <?php
                                                $sql = 'select * from tabel_paketharga';
                                                $query = mysqli_query($conn, $sql);
                                                $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                                var_dump($data);
                                                foreach ($data as $d) :
                                                ?>
                                                    <option value="<?= $d['nama_paket'] ?>"><?= $d['nama_paket'] ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="row"> -->
                                <!-- <div class="col-lg-6">
                                        <div class="form-group w-75">
                                            <label for="">Berat(Kg)</label>
                                            <input type="text" name="berat" class="form-control" placeholder="n(kg)">
                                        </div>
                                    </div> -->
                                <!-- <div class="col-lg-6">
                                        <div class="form-group w-75">
                                            <label for="">Harga</label>
                                            <input type="text" name="harga" class="form-control" placeholder="Harga...">
                                        </div>
                                    </div> -->
                                <!-- </div> -->

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group w-75">
                                            <label for="">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="tambahPesananUser" class="my-3  btn  btn-primary">Tambah Pesanan</button>
                                <button type="button" class="float-right my-3  btn  btn-info shadow-lg" onclick="location.reload()">Batal</button>
                        </div>
                        </form>
                    </div>
                </div>


                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Ingin Logout ?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Silahkan Klik Logout Jika Anda Ingin Keluar
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                    Batal
                                </button>
                                <a class="btn btn-primary" href="../../action/function.php?logout=1">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap core JavaScript-->
                <script src="../../assets/vendor/jquery/jquery.min.js"></script>
                <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="../../assets/js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="../../assets/vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="../../assets/js/demo/chart-area-demo.js"></script>
                <script src="../../assets/js/demo/chart-pie-demo.js"></script>
</body>

</html>