<?php
if ($module == ""){
include "modul/welcome.php";
}elseif ($module == "diagnosa"){
include "modul/diagnosa/diagnosa.php";
}elseif ($module == "penyakit"){
include "modul/penyakit/penyakit.php";
}elseif ($module == "post"){
include "modul/post/post.php";
}elseif ($module == "gejala"){
include "modul/gejala/gejala.php";
}elseif ($module == "pengetahuan"){
include "modul/pengetahuan/pengetahuan.php";
}elseif ($module == "riwayat-detail"){
include "modul/riwayat/detail.php";
}
?>