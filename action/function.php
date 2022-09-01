<?php

include 'connection/koneksi.php';
session_start();
function showAlert($type, $msg)
{
    return '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
    ' . $msg . '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

if (isset($_POST['login'])) {
    $username =  $_POST['username'];
    $password =  $_POST['password'];
    $sql =  "SELECT * FROM tabel_pengguna WHERE username='$username'";
    $query = mysqli_query($conn, $sql);
    session_start();
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['isLoginUser'] = true;
            $_SESSION['user'] = $user;

            if ($user['level'] != 'admin') {
                header('location:../index.php');
            } else {
                header('location:../view/admin/index.php');
            }
        } else {
            session_start();
            $_SESSION['loginStatus'] = false;
            $_SESSION['pesan'] = showAlert('danger', 'Username atau Password Salah');
            header('location:auth/login.php');
        }
    } else {
        session_start();
        $_SESSION['loginStatus'] = false;
        $_SESSION['pesan'] = showAlert('danger', 'Username Tidak Ada');
        header('location:auth/login.php');
    }
}

if (isset($_POST['daftarUser'])) {

    $nama =  $_POST['nama'];
    $username =  $_POST['username'];
    $postPassword =  $_POST['password'];
    $telepon =  $_POST['telepon'];
    $password = password_hash($postPassword, PASSWORD_DEFAULT);


    $checkUsername = mysqli_query($conn, "SELECT * FROM tabel_pengguna WHERE username = '$username'");

    if (mysqli_num_rows($checkUsername) >= 1) {
        session_start();
        $_SESSION['statusRegister'] = true;
        $_SESSION['pesan'] = showAlert('danger', 'Maaf Username sudah terpakai, Mohon gunakan username lain');
        header('location: auth/register.php');
    } else {
        session_start();
        $sql = "INSERT INTO `tabel_pengguna`(`id`, `nama`, `telepon`, `username`, `password`,`level`) VALUES (NULL,'$nama','$telepon','$username','$password','user')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $_SESSION['statusRegister'] = true;
            $_SESSION['pesan'] = showAlert('success', 'Berhasil Membuat Akun');
            header('location:auth/login.php');
        } else {
            $_SESSION['statusRegister'] = false;
            $_SESSION['pesan'] = showAlert('danger', 'Terjadi Kesalahan ! Gagal Membuat Akun');
            header('location:auth/login.php');
        }
    }
}


if (isset($_POST['tambahPesanan'])) {

    $username =  $_POST['username'];
    $telepon =  $_POST['telepon'];
    $alamat =  $_POST['alamat'];
    $paket =  $_POST['paket'];
    $berat =  $_POST['berat'];
    $harga =  $_POST['harga'];
    $tanggal =  $_POST['tanggal'];

    $date = new DateTime($tanggal);
    $now = new DateTime();

    if ($date < $now) {
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Membuat Pesanan ! Tanggal Tidak Valid');
        header('location:../view/admin/tambahPesanan.php');
    } else {
        $sql = "INSERT INTO `tabel_pesanan`(`id`, `username`, `telepon`, `alamat`, `nama_paket`, `berat`, `harga`, `status`, `tanggal`) VALUES (NULL,'$username','$telepon','$alamat','$paket','$berat','$harga', 'Belum diproses' ,'$tanggal')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            // $_SESSION['tambahSukses'] = true;
            $_SESSION['pesan'] = showAlert('success', 'Berhasil Menambah Pesanan');
            header('location:../view/admin/daftarPesanan.php');
        } else {
            // $_SESSION['tambahGagal'] = true;
            $_SESSION['pesan'] = showAlert('danger', 'Gagal Menambah Pesanan');
            header('location:../view/admin/daftarPesanan.php');
        }
    }
}


if (isset($_POST['editPesanan'])) {
    $username =  $_POST['username'];
    $telepon =  $_POST['telepon'];
    $alamat =  $_POST['alamat'];
    $paket =  $_POST['paket'];
    $berat =  $_POST['berat'];
    $harga =  $_POST['harga'];
    $tanggal =  $_POST['tanggal'];
    $status =  $_POST['status'];
    $id = $_POST['idPesanan'];

    $sql = "UPDATE `tabel_pesanan` SET `id`='$id',`username`='$username',`telepon`='$telepon',`alamat`='$alamat',`nama_paket`='$paket',`berat`='$berat',`harga`='$harga',`status`='$status',`tanggal`='$tanggal' WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // $_SESSION['tambahSukses'] = true;
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Mengupdate Pesanan');
        header('location:../view/admin/daftarPesanan.php');
    } else {
        // $_SESSION['tambahGagal'] = true;
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Mengupdate Pesanan');
        header('location:../view/admin/daftarPesanan.php');
    }
}

if (isset($_GET['deletePesanan'])) {
    $id = $_GET['id'];
    $sql = "delete from tabel_pesanan where id ='$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Menghapus Pesanan');
        header('location:../view/admin/daftarPesanan.php');
    } else {
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Menghapus Pesanan');
        header('location:../view/admin/daftarPesanan.php');
    }
}

if (isset($_POST['tambahPaket'])) {
    $namaPaket =  $_POST['namaPaket'];
    $lama =  $_POST['lama'];
    $harga =  $_POST['harga'];

    $sql = "INSERT INTO `tabel_paketharga`(`id`, `nama_paket`, `lama`, `harga`) VALUES (NULL,'$namaPaket','$lama','$harga')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // $_SESSION['tambahSukses'] = true;
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Menambah Jenis Paket');
        header('location:../view/admin/daftarPaket.php');
    } else {
        // $_SESSION['tambahGagal'] = true;
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Menambah Jenis Paket');
        header('location:../view/admin/daftarPaket.php');
    }
}


if (isset($_POST['editPaket'])) {
    $namaPaket =  $_POST['namaPaket'];
    $lama =  $_POST['lama'];
    $harga =  $_POST['harga'];
    $id = $_POST['idPaket'];

    $sql = "UPDATE `tabel_paketharga` SET `nama_paket`='$namaPaket',`lama`='$lama',`harga`='$harga' WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Mengupdate Jenis Paket');
        header('location:../view/admin/daftarPaket.php');
    } else {
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Mengupdate Jenis Paket');
        header('location:../view/admin/daftarPaket.php');
    }
}


if (isset($_GET['deletePaket'])) {
    $id = $_GET['id'];
    $sql = "delete from tabel_paketHarga where id ='$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Menghapus Jenis Paket');
        header('location:../view/admin/daftarPaket.php');
    } else {
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Menghapus Jenis Paket');
        header('location:../view/admin/daftarPaket.php');
    }
}

if (isset($_POST['tambahPengguna'])) {
    $username =  $_POST['username'];
    $password =  $_POST['password'];
    $telepon =  $_POST['telepon'];
    $nama =  $_POST['nama'];
    $level =  $_POST['level'];
    $securePassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `tabel_pengguna`(`id`, `nama`, `telepon`, `username`, `password`, `level`) VALUES (NULL,'$nama','$telepon','$username','$securePassword','$level')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // $_SESSION['tambahSukses'] = true;
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Menambah Pengguna');
        header('location:../view/admin/daftarPengguna.php');
    } else {
        // $_SESSION['tambahGagal'] = true;
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Menambah Pengguna');
        header('location:../view/admin/daftarPengguna.php');
    }
}

if (isset($_GET['deleteUsers'])) {
    $id = $_GET['id'];
    $sql = "delete from tabel_pengguna where id ='$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Menghapus Pengguna');
        header('location:../view/admin/daftarPengguna.php');
    } else {
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Menghapus Pengguna');
        header('location:../view/admin/daftarPengguna.php');
    }
}

if (isset($_POST['editProfileAdmin'])) {

    $id = $_POST['idAdmin'];
    $username =  $_POST['username'];
    $oldPassword =  $_POST['oldPassword'];
    $newPassword =  $_POST['newpassword'];
    $confirmPassword =  $_POST['confirmPassword'];
    $telepon =  $_POST['telepon'];
    $nama =  $_POST['nama'];
    // $level = mysqli_real_escape_string($conn, $_POST['level']);


    $pwSql = mysqli_query($conn, "select * from tabel_pengguna where id = '$id' ");
    $dataPw = mysqli_fetch_assoc($pwSql);
    // var_dump($dataPw);
    // var_dump($_POST);
    if (!empty($oldPassword)) {
        if ($newPassword != $confirmPassword) {
            $_SESSION['pesan'] = showAlert('danger', 'Password Baru Tidak Sama !');
            header('location:../view/admin/profile/viewProfile.php');
        } else {
            if (password_verify($oldPassword, $dataPw['password'])) {
                $securePassword = password_hash($newPassword, PASSWORD_DEFAULT);
                // echo $securePassword;
                $sql = "UPDATE `tabel_pengguna` SET `nama`='$nama',`telepon`='$telepon',`username`='$username',`password`='$securePassword' WHERE `id` = '$id'";
                $query = mysqli_query($conn, $sql);

                if ($query) {
                    // $_SESSION['tambahSukses'] = true;
                    $_SESSION['pesan'] = showAlert('success', 'Berhasil Mengupdate Profile');
                    header('location:../view/admin/profile/viewProfile.php');
                } else {
                    // $_SESSION['tambahGagal'] = true;
                    $_SESSION['pesan'] = showAlert('danger', 'Gagal Mengupdate Profile');
                    header('location:../view/admin/profile/viewProfile.php');
                }
            } else {
                $_SESSION['pesan'] = showAlert('danger', 'Password Lama Anda Salah ! Gagal Mengupdate Profile');
                header('location:../view/admin/profile/viewProfile.php');
            }
        }
    } else {
        // echo $securePassword;
        $sql = "UPDATE `tabel_pengguna` SET `nama`='$nama',`telepon`='$telepon',`username`='$username' WHERE `id` = '$id'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            // $_SESSION['tambahSukses'] = true;
            $_SESSION['pesan'] = showAlert('success', 'Berhasil Mengupdate Profile');
            header('location:../view/admin/profile/viewProfile.php');
        } else {
            // $_SESSION['tambahGagal'] = true;
            $_SESSION['pesan'] = showAlert('danger', 'Gagal Mengupdate Profile');
            header('location:../view/admin/profile/viewProfile.php');
        }
    }
}

// User Action

if (isset($_POST['tambahPesananUser'])) {
    $username =  $_POST['username'];
    $telepon =  $_POST['telepon'];
    $alamat =  $_POST['alamat'];
    $paket =  $_POST['paket'];
    // $berat =  $_POST['berat'];
    // $harga =  $_POST['harga'];
    $tanggal =  $_POST['tanggal'];

    // var_dump($_POST);

    $sql = "INSERT INTO `tabel_pesanan`(`id`, `username`, `telepon`, `alamat`, `nama_paket`, `berat`, `harga`, `status`, `tanggal`) VALUES (NULL,'$username','$telepon','$alamat','$paket',NULL,NULL, 'Belum diproses' ,'$tanggal')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // $_SESSION['tambahSukses'] = true;
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Menambah Pesanan');
        header('location:../view/user/daftarPesanan.php');
    } else {
        // $_SESSION['tambahGagal'] = true;
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Menambah Pesanan');
        header('location:../view/user/daftarPesanan.php');
    }
}

if (isset($_GET['deletePesananUser'])) {
    $id = $_GET['id'];
    $sql = "delete from tabel_pesanan where id ='$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Membatalkan Pesanan');
        header('location:../view/user/daftarPesanan.php');
    } else {
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Membatalkan Pesanan');
        header('location:../view/user/daftarPesanan.php');
    }
}
if (isset($_GET['antarPesananUser'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `tabel_pesanan` SET status = 'Permintaan pengantaran' WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Mengkonfirmasi Pengantaran Pesanan');
        header('location:../view/user/daftarPesanan.php');
    } else {
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Mengkonfirmasi Pengantaran Pesanan');
        header('location:../view/user/daftarPesanan.php');
    }
}
if (isset($_GET['konfirmasiPesananUser'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `tabel_pesanan` SET status = 'Selesai' WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $_SESSION['pesan'] = showAlert('success', 'Berhasil Menyelesaikan Pesanan');
        header('location:../view/user/daftarPesanan.php');
    } else {
        $_SESSION['pesan'] = showAlert('danger', 'Gagal Menyelesaikan Pesanan');
        header('location:../view/user/daftarPesanan.php');
    }
}


if (isset($_POST['editProfileUser'])) {

    $id = $_POST['idUser'];
    $username =  $_POST['username'];
    $oldPassword =  $_POST['oldPassword'];
    $newPassword =  $_POST['newpassword'];
    $confirmPassword =  $_POST['confirmPassword'];
    $telepon =  $_POST['telepon'];
    $nama =  $_POST['nama'];


    $pwSql = mysqli_query($conn, "select * from tabel_pengguna where id = '$id' ");
    $dataPw = mysqli_fetch_assoc($pwSql);
    // var_dump($dataPw);
    // var_dump($_POST);

    if (!empty($oldPassword)) {
        if ($newPassword != $confirmPassword) {
            $_SESSION['pesan'] = showAlert('danger', 'Password Baru Tidak Sama !');
            header('location:../view/user/profile/viewProfile.php');
        } else {
            if (password_verify($oldPassword, $dataPw['password'])) {
                $securePassword = password_hash($newPassword, PASSWORD_DEFAULT);
                // echo $securePassword;
                $sql = "UPDATE `tabel_pengguna` SET `nama`='$nama',`telepon`='$telepon',`username`='$username',`password`='$securePassword' WHERE `id` = '$id'";
                $query = mysqli_query($conn, $sql);

                if ($query) {
                    // $_SESSION['tambahSukses'] = true;
                    $_SESSION['pesan'] = showAlert('success', 'Berhasil Mengupdate Profile');
                    header('location:../view/user/profile/viewProfile.php');
                } else {
                    // $_SESSION['tambahGagal'] = true;
                    $_SESSION['pesan'] = showAlert('danger', 'Gagal Mengupdate Profile');
                    header('location:../view/user/profile/viewProfile.php');
                }
            } else {
                $_SESSION['pesan'] = showAlert('danger', 'Password Lama Anda Salah ! Gagal Mengupdate Profile');
                header('location:../view/user/profile/viewProfile.php');
            }
        }
    } else {
        // echo $securePassword;
        $sql = "UPDATE `tabel_pengguna` SET `nama`='$nama',`telepon`='$telepon',`username`='$username' WHERE `id` = '$id'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            // $_SESSION['tambahSukses'] = true;
            $_SESSION['pesan'] = showAlert('success', 'Berhasil Mengupdate Profile');
            header('location:../view/user/profile/viewProfile.php');
        } else {
            // $_SESSION['tambahGagal'] = true;
            $_SESSION['pesan'] = showAlert('danger', 'Gagal Mengupdate Profile');
            header('location:../view/user/profile/viewProfile.php');
        }
    }
}








if (isset($_GET['logout'])) {
    unset($_SESSION);
    session_destroy();
    header('location:auth/login.php');
}
