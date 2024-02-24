<?php
$title = 'pengguna';
require 'functions.php';

$tgl_sekarang = date('Y-m-d h:i:s');
$tujuh_hari = mktime(0, 0, 0, date("n"), date("j") + 7, date("Y"));
$batas_waktu = date("Y-m-d h:i:s", $tujuh_hari);

$invoice = 'INV' . date('Ymdsi');
$outlet_id = $_GET['outlet_id'];
$user_id = $_SESSION['user_id'];
$member_id = $_GET['id'];

$outlet = ambilsatubaris($conn, 'SELECT nama_outlet from outlet WHERE id_outlet = ' . $outlet_id);
$member = ambilsatubaris($conn, 'SELECT nama_member from member WHERE id_member = ' . $member_id);
$paket = ambildata($conn, 'SELECT * FROM paket WHERE outlet_id = ' . $outlet_id);

// Menghitung jumlah transaksi berdasarkan ID member
$queryCount = "SELECT COUNT(*) as total_transaksi FROM transaksi WHERE member_id = $member_id";
$resultCount = mysqli_query($conn, $queryCount);

if ($resultCount) {
    $rowCount = mysqli_fetch_assoc($resultCount);
    $total_transaksi = $rowCount['total_transaksi'];
} else {
    $total_transaksi = 0; // Jika ada kesalahan, anggap jumlah transaksi = 0
}

// Menentukan apakah member layak mendapatkan diskon berdasarkan jumlah transaksi
if ($total_transaksi > 3) {
    // Member mendapatkan diskon 10%
    $diskon = 0.1;
    // Tampilkan pesan diskon pada halaman
} else {
    // Member tidak mendapatkan diskon
    $diskon = 0;
}

if (isset($_POST['btn-simpan'])) {
    $kode_invoice = $_POST['kode_invoice'];
    $biaya_tambahan = $_POST['biaya_tambahan'];
    $pajak = 0.1; // Inisialisasi nilai pajak

    $query = "INSERT INTO transaksi (outlet_id, kode_invoice, member_id, tgl, batas_waktu, biaya_tambahan, diskon, pajak, status, status_bayar, user_id) 
              VALUES ('$outlet_id', '$kode_invoice', '$member_id', '$tgl_sekarang', '$batas_waktu', '$biaya_tambahan', '$diskon', '$pajak', 'baru', 'belum', '$user_id')";

    $execute = bisa($conn, $query);
    if ($execute == 1) {
        // Ambil ID transaksi yang baru saja dimasukkan
        $transaksi_id = mysqli_insert_id($conn);

        $paket_id = $_POST['paket_id'];
        $qty = $_POST['qty'];
        $hargapaket = ambilsatubaris($conn, 'SELECT harga from paket WHERE id_paket = ' . $paket_id);
        $total = $hargapaket['harga'] * $qty;
        $total_asli = $total + $biaya_tambahan;
        $total_diskon = $total_asli * $diskon;
        $total_setelah_diskon = $total_asli - $total_diskon;
        $total_pajak = $total_setelah_diskon * $pajak;
        $total_harga = $total_setelah_diskon + $total_pajak;

        $sqlDetail = "INSERT INTO detail_transaksi (transaksi_id, paket_id, qty, total_harga, total_pajak, total_diskon , total_asli) VALUES ('$transaksi_id', '$paket_id', '$qty', '$total_harga' , '$total_pajak', '$total_diskon', '$total_asli')";
        $executeDetail = bisa($conn, $sqlDetail);

        if ($executeDetail == 1) {
            // echo $total_pajak;
            header('location: transaksi_sukses.php?id=' . $transaksi_id);
            exit;
        } else {
            echo "Gagal Tambah Data";
        }
    }
}

require 'layout_header.php';
?>



<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Transaksi</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="btn-bread"><a href="#">Paket</a></li>
                <li><a href="#">Tambah Transaksi</a></li>
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
                <form method="post" action="">
                    <div class="form-group">
                        <label>Kode Invoice</label>
                        <input type="text" name="kode_invoice" class="form-control" readonly="" value="<?= $invoice ?>">
                    </div>
                    <div class="form-group">
                        <label>Outlet</label>
                        <input type="text" name="username" class="form-control" readonly="" value="<?= $outlet['nama_outlet'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <input type="text" name="password" class="form-control" readonly="" value="<?= $member['nama_member'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Pilih Paket</label>
                        <select name="paket_id" class="form-control">
                            <?php foreach ($paket as $key) : ?>
                                <option value="<?= $key['id_paket'] ?>"><?= $key['nama_paket'];  ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" name="qty" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Biaya Tambahan</label>
                        <input type="text" name="biaya_tambahan" class="form-control" value="0">
                    </div>
                    <?php if ($total_transaksi > 3) {
                        // Member mendapatkan diskon 10%
                        // $diskon = 0.1;
                        // Tampilkan pesan diskon pada halaman
                        echo "<p>
                        Selamat anda mendapatkan diskon sebesar 10%, total transaksi anda $total_transaksi 
  </p>";
                    } else {
                        // Member tidak mendapatkan diskon
                        // $diskon = 0;s
                        echo "<p>
                        Maaf anda tidak mendapatkan diskon butuh minimal 3 transaksi, total transaksi anda $total_transaksi 
  </p>";
                        // echo "<p>Maaf anda tidak mendapatkan diskon butuh $total_transaksi transaksi lagi</p>";

                    }
                    ?>
                    <p>pajak sebesar 10%</p>
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