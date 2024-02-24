<?php
$title = 'pengguna';
require_once 'functions.php';
$outlet = ambildata($conn, 'SELECT * FROM outlet');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check koneksi
    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    $nama     = $_POST['nama_user'];
    $username = $_POST['username'];
    $pass     = md5($_POST['password']);
    $role     = $_POST['role'];
    $outlet_id = $_POST['outlet_id'];

    // Periksa apakah file gambar telah diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $gambar = $_FILES['gambar']['name'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];

        // Pindahkan file gambar ke direktori yang diinginkan (pastikan direktori "uploads" sudah ada)
        $path = '../uploads/' . $gambar;
        move_uploaded_file($gambar_tmp, $path);
    } else {
        $gambar = ''; // Jika tidak ada gambar diunggah
    }

    if ($role == 'kasir') {
        $query = "INSERT INTO user (nama_user, username, password, role, gambar, outlet_id) VALUES ('$nama', '$username', '$pass', '$role', '$gambar', '$outlet_id')";
    } else {
        $query = "INSERT INTO user (nama_user, username, password, gambar, role) VALUES ('$nama', '$username', '$pass', '$gambar', '$role')";
    }

    $execute = bisa($conn, $query);
    if ($execute) {
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil menambahkan ' . $role . ' baru';
        $type = 'success';
        header('location: pengguna.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
        exit();
    } else {
        echo "Gagal Tambah Data";
    }
}


require 'layout_header.php';
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Pengguna</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="outlet.php">Pengguna</a></li>
                <li><a href="#">Tambah Pengguna</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data"><i class="fa fa-refresh" id="ic-refresh"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Pengguna</label>
                        <input type="text" name="nama_user" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="owner">Owner</option>
                            <option value="kasir">Kasir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Masukkan Gambar</label>
                        <input type="file" name="gambar" id="gambar">
                    </div>
                    <div class="form-group">
                        <label>Jika Role Nya Kasir Maka Pilih Outlet Dimana Dia Akan Ditempatkan</label>
                        <select name="outlet_id" class="form-control">
                            <?php foreach ($outlet as $key) : ?>
                                <option value="<?= $key['id_outlet'] ?>"><?= $key['nama_outlet'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="text-right">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" name="btn-simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require 'layout_footer.php';
?>