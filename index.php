<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
session_start();

$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "spkayam"; 

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
    <link rel="icon" href="aset\banner\logopakarayam.png">
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="aset/jQuery-2.js"></script>
    <script src="aset/bootstrap.js"></script>

    <style>
        .body {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
        }
        .content-wrapper {
            margin-left: 0;
            width: 100%;
            
        }

        nav{
            background-color:#ce0606 !important;
        }

        .navbar a, .navbar-custom-menu a {
            font-size: 18px; 
            padding: 10px 15px; 
        }

    </style>
</head>

<body id="pakarayam" class="hold-transition skin-purple-light sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="" class="logo" style="background-color:#ce0606 !important;">
                <h3>PAKAR AYAM</h3>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <?php include "menu.php"; ?>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="content-wrapper" style="min-height: 310px;">
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <?php include "content.php"; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
