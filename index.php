<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
session_start();

// Koneksi Database
$host = "localhost";
$user = "root";
$pass = ""; // Kosongkan jika tidak ada password
$db   = "spkayam"; // Nama database

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" href="gambar/admin/favicon.png">
    <link href="css/font-awesome-4.2.0/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/owl-carousel/owl.carousel.css" rel="stylesheet" media="all">
    <link href="css/owl-carousel/owl.theme.css" rel="stylesheet" media="all">
    <link href="css/magnific-popup.css" rel="stylesheet" media="all" />
    <link href="css/font.css" rel="stylesheet" media="all">
    <link href="css/fontello.css" rel="stylesheet" media="all">
    <link href="css/main.css" rel="stylesheet" media="all"/>
    <link href="css/style.css" rel="stylesheet">
    <link href="aset/bootstrap.css" rel="stylesheet">
    <link href="aset/AdminLTE.css" rel="stylesheet">
    <link href="aset/Ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="aset/skins/_all-skins.min.css" rel="stylesheet">
    <script src="aset/jQuery-2.js"></script>
    <script src="aset/bootstrap.js"></script>
</head>

<body id="pakarayam" class="hold-transition skin-purple-light sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="./" class="logo">
                <span class="logo-mini"><b><i class="fa fa-contao" aria-hidden="true"></i>XS</b></span>
                <span class="logo-lg"><b><i class="fa fa-contao" aria-hidden="true"></i>hirexs 1.0</b></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <?php if (isset($_SESSION['username']) && isset($_SESSION['password'])): ?>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="gambar/admin/admin.png" class="user-image" alt="User Image">
                                    <?php echo ucfirst($_SESSION['username']); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="gambar/admin/admin.png" class="img-circle" alt="User Image">
                                        <p>Login sebagai <?php echo ucfirst($_SESSION['username']); ?></p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a class="btn btn-default btn-flat" href="?module=tentang">Tentang</a>
                                        </div>
                                        <div class="pull-right">
                                            <a class="btn btn-default btn-flat" href="logout.php">LogOut</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li><a href="formlogin"><i class="fa fa-sign-in"></i> Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="header">Menu</li>
                    <?php include "menu.php"; ?>
                </ul>
            </section>
        </aside>

        <div class="content-wrapper" style="min-height: 310px;">
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <?php include "content.php"; ?>
                    </div>
                </div>
            </section>
        </div>

  

        <div class="control-sidebar-bg"></div>
    </div>

    <script>
        function kirimContactForm() {
            var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            var nama = $('#masukkanNama').val();
            var email = $('#masukkanEmail').val();
            var pesan = $('#masukkanPesan').val();

            if (nama.trim() == '') {
                alert('Masukkan nama Anda.');
                $('#masukkanNama').focus();
                return false;
            } else if (email.trim() == '' || !reg.test(email)) {
                alert('Masukkan email yang valid.');
                $('#masukkanEmail').focus();
                return false;
            } else if (pesan.trim() == '') {
                alert('Masukkan pesan Anda.');
                $('#masukkanPesan').focus();
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'kirim_form.php',
                    data: {
                        contactFrmSubmit: 1,
                        nama: nama,
                        email: email,
                        pesan: pesan
                    },
                    success: function (msg) {
                        alert(msg == 'ok' ? 'Pesan terkirim!' : 'Terjadi masalah, coba lagi.');
                    }
                });
            }
        }
    </script>
</body>
</html>

<?php ob_end_flush(); ?>
