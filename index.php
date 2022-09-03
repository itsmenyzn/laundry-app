<?php

include 'action/connection/koneksi.php';
include 'action/function.php';
// session_start();

if (isset($_SESSION['isLoginUser'])) {
    $user = $_SESSION['user'];
} else {
    $user = '';
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

    <title>Laundry App - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />
    <style>
        .mapouter {
            position: relative;
            text-align: right;
            height: 100px;
            width: 100px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
        <a class="navbar-brand" href="#">Bali Laundry</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link mr-3" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-3" href="#sectionServices">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-3" href="#sectionContact">Contact Us</a>
                </li>
                <li class="nav-item">
                    <?php if ($user != '') { ?>
                        <div class="dropdown">
                            <a class="dropdown-toggle nav-item nav-link" data-toggle="dropdown" href="#">Pesanan</a>
                            <div class="dropdown-menu mt-2">
                                <a class="dropdown-item" href="view/user/daftarPesanan.php">Daftar Pesanan</a>
                                <a class="dropdown-item" href="view/user/daftarPesanan.php">Buat Pesanan</a>
                            </div>
                        </div>
                </li>
                <li class="nav-item mr-5">
                    <div class="dropdown">
                        <a class="dropdown-toggle nav-item nav-link" data-toggle="dropdown" href="#"><?= $user['nama'] ?></a>
                        <div class="dropdown-menu mt-2">
                            <a class="dropdown-item" href="view/user/profile/viewProfile.php">Lihat Akun</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                Logout
                            </a>
                        </div>
                    </div>
                <?php  } else { ?>
                    <a href="action/auth/login.php" class="btn btn-block btn-primary">Login</a>
                <?php  } ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container my-5" id="sectionMain">
        <?php if (isset($_SESSION['pesan'])) {
            echo $_SESSION['pesan'];
            unset($_SESSION['pesan']);
        } ?>
        <div class="row">
            <div class="col-lg-6 textMain">
                <h3><b>Bali Laundry</b></h3>
                <p>Kami Bergerak Dibidang Usaha Jasa Binatu / Laundry Di Wilayah Denpasar Bali Dan Sekitarnya, Yang Melayani Permintaan Jasa Laundry Baik Personal, Keluarga Serta Wisatawan. Kami Menawarkan Jasa Laundry Kiloan, Untuk Mempermudah Konsumen Serta Lebih Berhemat Dengan Kuantitas Pekerjaan Borongan.</p>
                <?php if ($user == '') { ?>
                    <h5 class="my-3"><i><b>Anda Dapat Login / Daftar Dahulu untuk membuat Pesanan</b></i></h6>
                    <?php } ?>
                    <p> <b><i>Find Us On</i></b>
                        <a href="#"><img src="assets/img/instagram_icon.png" width="30px" height="30px" class="ml-3" alt=""></a>
                        <a href="#"><img src="assets/img/facebook_icon.png" width="30px" height="30px" alt=""></a>
                        <a href="#"><img src="assets/img/whatsapp_icon.png" width="30px" height="30px" alt=""></a>
                    </p>
            </div>
            <div class="col-lg-6">
                <img src="assets/img/loginImg.jpg" class="shadow-lg" width="450px" height="350px" alt="">
            </div>
        </div>
    </div>
    <div class="container" id="sectionServices">
        <center>
            <h3 class="mb-5">Layanan Paket Bali Laundry</h3>
        </center>
        <div class="row d-flex justify-content-between">
            <div class="col-lg-3">
                <div class="card shadow  mt-5">
                    <img class="card-img-top rounded" src="assets/img/bannerReguler.png" alt="Card image cap">
                    <div class="card-body p-4">
                        <center>
                            <!-- <img src="assets/img/bannerReguler.png" class="img-fluid mt-2 mb-4 w-50 h-50" alt=""> -->
                            <h5 class="mt-2 mb-4">Reguler</h5>
                            <h5 class="mb-3">Cuci - Setrika - Lipat</h5>

                        </center>
                        <p>
                            Jasa layanan laundry dengan kisaran harga Rp. 7.000 / kg untuk pengerjaan 2 hari wilayah Denpasar Bali dan sekitarnya, jasa terkait proses cuci, setrika, lipat hingga packing.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card shadow ">
                    <img class="card-img-top rounded" src="assets/img/bannerSpecial.jpg" alt="Card image cap">
                    <div class="card-body p-4">
                        <center>
                            <!-- <img src="assets/img/bannerReguler.png" class="img-fluid mt-2 mb-4 w-50 h-50" alt=""> -->
                            <h5 class="mt-2 mb-4">Special</h5>
                            <h5 class="mb-3">Cuci - Setrika - Lipat - Pewangi</h5>

                        </center>
                        <p>
                            Jasa layanan laundry dengan kisaran harga Rp. 20.000 / kg untuk pengerjaan 3 jam wilayah Denpasar Bali dan sekitarnya, jasa terkait proses cuci, setrika, lipat, pewangi hingga packing.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card shadow mt-4">
                    <img class="card-img-top rounded" src="assets/img/bannerExpress.jpg" alt="Card image cap">
                    <div class="card-body p-4">
                        <center>
                            <!-- <img src="assets/img/bannerReguler.png" class="img-fluid mt-2 mb-4 w-50 h-50" alt=""> -->
                            <h5 class="mt-2 mb-4">Express</h5>
                            <h5 class="mb-3">Cuci - Setrika - Lipat</h5>

                        </center>
                        <p>

                            Jasa layanan laundry dengan kisaran harga Rp. 10.000 / kg untuk pengerjaan 1 hari atau 24 jam wilayah Denpasar Bali dan sekitarnya, jasa terkait proses cuci, setrika, lipat, hingga packing.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5" id="sectionContact">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="text-center">Kontak Bali Laundry</h4>
                <hr>
                <div class="row">
                    <div class="col-lg-1">
                        <p><i class="fab fa-whatsapp fa-2x"></i></p>
                        <p><i class="fab fa-whatsapp fa-2x"></i></p>
                    </div>
                    <div class="col-lg-11" style="line-height: 35px;">
                        <p>081-xxx-xxxx - Admin Jono</p>
                        <p>082-xxx-xxxx - Admin Supri</p>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <h4 class="jamBukaContact" style="margin-left: -30px;">Jam Operasional</h4>
                    <hr>
                    <table class="table table-borderless text-center   ">
                        <tbody class="font-weight-normal">
                            <tr>
                                <td>Sen - Kam:</td>
                                <td>7.30 - 22.00</td>
                            </tr>
                            <tr>
                                <td>Jum - Sab:</td>
                                <td>08.00 - 21.00</td>
                            </tr>
                            <tr>
                                <td>Minggu:</td>
                                <td>09.00 - 18.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 ">
                <h5 class="ml-5"><b>Temukan Lokasi Kami di Google Maps</b></h5>
                <div class="mapouter">
                    <div class="gmap_canvas me-5">
                        <iframe width="550" height="450" id="gmap_canvas" src="https://maps.google.com/maps?q=itb%20stikom%20bali&t=k&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        <a href="https://www.whatismyip-address.com"></a><br>

                    </div>
                </div>
            </div>
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
                    <a class="btn btn-primary" href="action/function.php?logout=1">Logout</a>
                </div>
            </div>
        </div>
    </div>






    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>

</html>