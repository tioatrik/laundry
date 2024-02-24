<?php
require_once 'functions.php';
$id_user_header = @$_GET['id_user'];
$query_header = "SELECT * FROM user WHERE id_user= '$id_user_header'";
$result = mysqli_query($conn, $query_header);
$data_header = ambilsatubaris($conn, $query_header);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/plugins/images/favicon.png">
    <title>Aplikasi Penglolaan Laundry</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="../assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="../assets/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../assets/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="../assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="../assets/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.min.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <style>
        img {
            width: 40px !important;
            height: 40px !important;
            margin-right: 7px;
            border: 1px solid white;
        }

        b {
            margin-right: 10px !important;
        }

        .sidebar-nav.slimscrollsidebar {
            background-color: #2F323E !important;
        }

        .top-left-part {
            background-color: #2F323E !important;

        }

        .logo b {
            color: crimson !important;
        }

        #side-menu>li>a.active {
            color: white;
            border-left: 3px solid crimson;
        }

        #side-menu>li>a {
            color: white;
        }



        .navbar-profile {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-right: 30px;
            padding-top: 10px;
        }

        .profile-picture {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .profile-name {
            color: white;
            font-weight: bold;
        }

        .profile-role {
            font-size: 0.8em;
            color: white;
        }
    </style>
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <?php if ($title == 'dashboard') { ?>
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
    <?php } ?>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="index.php">
                        <!-- logo -->
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAACZElEQVR4nO2Vz2vUQBzFv/7CIoKXHiylpeBJL94EddcFvYlQ3GEvggiKi1jBekiKsFDYP0DqsVdRPKsoZhR/3HoVlN1sZ1g9SGlSa2mTVUH7JLvbutXWndiQTiQPHjkkh/eZ9/1miFKlikcfH2KP5ChLC1JyfJMc08JCqfYEuykJ4QXHlOTA7xYcr+sv0UM6SwYnv074VQgLJdJZsjU2GwJICzXSWbI18xsDcHylhDcgKMk7IDnKlOC/0FTwnhJ0D4jmTrSe5USET7XVEhYaXZY4+BM9tZ+jnxILwJs38mdhoUhJBZC/2nisVRsiLEAX+8zEfO8AXKI/vHTyfPO9nzfe4cJ4T2wAwkIlDMBi7hzmduxaE35+4FArfNseMx8gN74zngaeYZ/guC45FlUAmgFPX8XC4VNYOHgci5nCmvAdnowFYOVCC2ZfWLijAuCrOm+UYwPolF+40e8x833owGwdnzVHYwf4Mjw25DGj3hlkiRnLYcN7eeOHx4yLsQMEahTGBj1myHaQD37e9FVCN5g50V7kZZ8ZV/45/GYBVpvIm6/aT08FAETbPGZObOrkowLolCoARakUYKsbGB0ErvX93feK6NUWYGQ/Gt0Ain0a78BIBABZ20VgelRRcnbl+xSAom0grEmXBgJlbOeFavBM1flOwHatALJV974ygO3ORBI+YoDbIcbnjX4AtlMKMUJcO4CM7VxWHyHnrnYA2ao7HGKEbmkHcGL601F1gLmb2gEcq80eUAaoOpe0A8i9nd2rvAM154x2AIGyVddXHKEjWgJkbLeuApCrzAxFBpAq1X+sn47gxgxwS/gMAAAAAElFTkSuQmCC">
                    </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!-- <li>
                        <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    </li> -->
                    <li>
                        <div class="navbar-profile">
                            <img src="./uploads/<?= @$_SESSION['gambar']; ?>" alt="User" class="profile-picture">
                            <div class="profile-info">
                                <span class="profile-name"><?= @$_SESSION['username'];  ?></span>
                                <span class="profile-role"><?= @$_SESSION['role'];  ?></span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="index.php" class="waves-effect <?php if ($title == 'dashboard') {
                                                                    echo 'active';
                                                                } ?>"><i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="pelanggan.php" class="waves-effect <?php if ($title == 'pelanggan') {
                                                                        echo 'active';
                                                                    } ?>"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Pelanggan</a>
                    </li>
                    <li>
                        <a href="transaksi.php" class="waves-effect"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> Transaksi</a>
                    </li>
                    <li>
                        <a href="laporan.php" class="waves-effect <?php if ($title == 'laporan') {
                                                                        echo 'active';
                                                                    } ?>"><i class="fa fa-file-text fa-fw" aria-hidden="true"></i> Laporan</a>
                    </li>
                </ul>
                <div class="center p-20">
                    <a href="logout.php" class="btn btn-danger btn-block waves-effect waves-light">Logout</a>
                </div>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">