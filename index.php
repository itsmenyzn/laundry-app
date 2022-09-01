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
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
        <a class="navbar-brand" href="#">Laundry</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
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
                <h3>Title Landing Page</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum pariatur quasi nulla corporis aspernatur, iure voluptatem quia vero facilis sit quod. Magnam, eius animi. Dicta, incidunt dolorum, earum officia error voluptatum exercitationem, veritatis eos libero laudantium nesciunt maxime obcaecati quis!</p>
                <p>Find Us On
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
    <div class="container my-3" id="sectionServices">
        <center>
            <h3 class="my-5">Info Paket Service Laundry</h3>
        </center>
        <div class="row d-flex marleft">
            <div class="col-lg-4">
                <div class="card cardServices">
                    <div class="card-body text-center ">
                        <img src="assets/img/express_service.png" class="kelasImage w-25 mb-4 " alt="">
                        <p class="card-text "><b>Express </b></p>
                        <p class="fs-6 ">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore, </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card cardServices">
                    <div class="card-body text-center ">
                        <img src="assets/img/express_service.png" class="kelasImage w-25 mb-4" alt="">
                        <p class="card-text "><b>Express </b></p>
                        <p class="fs-6 ">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore, </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card cardServices">
                    <div class="card-body text-center ">
                        <img src="assets/img/express_service.png" class="kelasImage w-25 mb-4" alt="">
                        <p class="card-text "><b>Express </b></p>
                        <p class="fs-6 ">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore, </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5" id="sectionContact">
        <center>
            <h1 class="my-5">Contact Us</h1>
        </center>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card cardContact">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label class="textWhite" for="name">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Nama Anda...">
                            </div>
                            <div class="form-group">
                                <label class="textWhite" for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email...">
                            </div>

                            <div class="form-group">
                                <label class="textWhite" for="message">Message</label>
                                <textarea class="form-control" id="message" rows="10" placeholder="Pesan Anda..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary px-4 py-2">Send</button>
                        </form>
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