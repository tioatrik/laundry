
<?php
$title = 'transaksi';
require 'functions.php';
require 'layout_header.php';
$query = "SELECT transaksi.*,member.nama_member , detail_transaksi.total_harga FROM transaksi INNER JOIN member ON member.id_member = transaksi.member_id INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi WHERE transaksi.status_bayar='belum'";
$data = ambildata($conn, $query);
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master <?= $title ?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="btn-bread"><a href="#">Paket</a></li>
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
                <div class="table-responsive">
                    <table class="table table-bordered thead-dark" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Member</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($data) || is_object($data)) {
                                $no = 1;
                                foreach ($data as $transaksi) :
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($transaksi['kode_invoice']); ?></td>
                                        <td><?= htmlspecialchars($transaksi['nama_member']); ?></td>
                                        <td><?= htmlspecialchars($transaksi['status']); ?></td>
                                        <td><?= htmlspecialchars($transaksi['total_harga']); ?></td>
                                        <td align="center">
                                            <a href="transaksi_bayar.php?id=<?= $transaksi['id_transaksi']; ?>" data-toggle="tooltip" data-placement="bottom" title="Pilih" class="btn btn-primary btn-block">Pilih</a>
                                        </td>
                                    </tr>
                            <?php
                                endforeach;
                            } else {
                                // Lakukan sesuatu jika $penjualan bukan array atau objek (misalnya, menampilkan pesan bahwa tidak ada transaksi yang tersedia)
                                echo "<tr><td colspan='5'>Tidak ada transaksi yang tersedia.</td></tr>";
                            }
                            ?>

                            <!--  -->

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- table -->
    <!-- ============================================================== -->
    <div class="row">

    </div>
</div>
<?php
require 'layout_footer.php';
