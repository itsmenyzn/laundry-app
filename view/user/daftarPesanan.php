<?php

include '../../action/connection/koneksi.php';
include '../../action/function.php';

if (isset($_SESSION['isLoginUser'])) {
    $user = $_SESSION['user'];
    $username = $user['username'];
    // var_dump($username);
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

    <title>Laundri App - Admin Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css">
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pesanan Laundry</h6>
                        </div>
                        <div class="card-body">
                            <?php if (isset($_SESSION['pesan'])) {
                                echo $_SESSION['pesan'];
                                unset($_SESSION['pesan']);
                            } ?>
                            <a href="buatPesanan.php" class="mb-3 btn  btn-primary float-right">Buat Pesanan</a>
                            <a href="../../index.php" class="mb-3 btn  btn-primary float-left">Kembali</a>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataPesanan" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Telepon</th>
                                            <th>Alamat</th>
                                            <th>Paket</th>
                                            <th>Berat (Kg)</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th class="text-center">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "select * from tabel_pesanan where username = '$username'";
                                        $query = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                        if (mysqli_num_rows($query) == 0) {
                                            echo '<tr>
                                            <td colspan="10" class="text-center">Data Pesanan Belum Ada</td>
                                        </tr>';
                                        }
                                        $no = 1;
                                        foreach ($data as $row) :
                                        ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $row['username'] ?></td>
                                                <td><?= $row['telepon'] ?></td>
                                                <td><?= $row['alamat'] ?></td>
                                                <td><?= $row['nama_paket'] ?></td>
                                                <td><?= $row['berat'] ?></td>
                                                <td><?= $row['harga'] ?></td>
                                                <td><?= $row['status'] ?></td>
                                                <td><?= $row['tanggal'] ?></td>
                                                <?php if ($row['status'] == 'Belum diproses') { ?>
                                                    <td class="d-flex justify-content-between ">
                                                        <a class="btn btn-danger btn-block btn-md" href="#" data-toggle="modal" data-target="#deleteModal">
                                                            Batal
                                                        </a>
                                                    </td>
                                                <?php } else if ($row['status'] == 'Selesai') { ?>
                                                    <td class="d-flex justify-content-between ">
                                                        <a class="btn btn-info btn-block btn-md" href="#" data-toggle="modal" data-target="#deleteModal">
                                                            Antar
                                                        </a>
                                                    </td>

                                                <?php } else { ?>
                                                    <td class="d-flex justify-content-between ">
                                                        <a class="btn btn-secondary btn-block btn-md" href="#" data-toggle="modal" data-target="#">
                                                            Batal
                                                        </a>
                                                    </td>

                                                <?php } ?>


                                            </tr>
                                        <?php
                                            $no++;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                                <p class="medium"><i>Note: <b>Pesanan yang sedang diproses tidak dapat dibatalkan</b></i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->


    <!-- Logout Modal-->
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

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Ingin Membatalkan Pesanan Ini ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Klik Ya Jika Ingin Membatalkan Pesanan
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Batal
                    </button>
                    <a href="../../action/function.php?deletePesananUser=1&id=<?= $row['id'] ?>" class="btn btn-danger"> Hapus </a>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/js/demo/datatables-demo.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataPesanan').DataTable();
        });
    </script>
</body>

</html>