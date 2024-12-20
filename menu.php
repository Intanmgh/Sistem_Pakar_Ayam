<?php
$module = isset($_GET['module']) ? $_GET['module'] : '';
?>

<li><a <?php if ($module == "") echo 'class="active"'; ?> href="./"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
<li><a <?php if ($module == "diagnosa") echo 'class="active"'; ?> href="diagnosa"><i class="fa fa-search-plus"></i> <span>Diagnosa</span></a></li>
<li><a <?php if ($module == "penyakit") echo 'class="active"'; ?> href="penyakit"><i class="fa fa-bug"></i> <span>Penyakit</span></a></li>
<li><a <?php if ($module == "gejala") echo 'class="active"'; ?> href="gejala"><i class="fa fa-eyedropper"></i> <span>Gejala</span></a></li>
<li><a <?php if ($module == "pengetahuan") echo 'class="active"'; ?> href="pengetahuan"><i class="fa fa-flask"></i> <span>Pengetahuan</span></a></li>
