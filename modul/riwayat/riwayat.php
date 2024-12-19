<title>Riwayat - Chirexs 1.0</title>
<h2 class='text text-primary'>Riwayat Konsultasi</h2>
<hr>
<?php
include "config/fungsi_alert.php";
$aksi = "modul/riwayat/aksi_hasil.php";
$act = $_GET['act'] ?? '';  // Menangani parameter act
$offset = $_GET['offset'] ?? 0;  // Menangani parameter offset

switch ($act) {
    default:
        $limit = 15;
        if (empty($offset)) {
            $offset = 0;
        }

        $sqlgjl = mysqli_query($conn, "SELECT * FROM gejala order by kode_gejala+0");
        while ($rgjl = mysqli_fetch_array($sqlgjl)) {
            $argjl[$rgjl['kode_gejala']] = $rgjl['nama_gejala'];
        }

        $sqlpkt = mysqli_query($conn, "SELECT * FROM penyakit order by kode_penyakit+0");
        while ($rpkt = mysqli_fetch_array($sqlpkt)) {
            $arpkt[$rpkt['kode_penyakit']] = $rpkt['nama_penyakit'];
            $ardpkt[$rpkt['kode_penyakit']] = $rpkt['det_penyakit'];
            $arspkt[$rpkt['kode_penyakit']] = $rpkt['srn_penyakit'];
        }

        $tampil = mysqli_query($conn, "SELECT * FROM hasil ORDER BY id_hasil");
        $baris = mysqli_num_rows($tampil);
        if ($baris > 0) {
            echo "<div class='row'><div class='col-md-8'><table class='table table-bordered table-striped riwayat' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Penyakit</th>
                    <th nowrap>Nilai CF</th>
                   
                </tr>
            </thead>
            <tbody>";
            $hasil = mysqli_query($conn, "SELECT * FROM hasil ORDER BY id_hasil limit $offset, $limit");
            $no = 1 + $offset;
            $counter = 1;
            while ($r = mysqli_fetch_array($hasil)) {
                if ($r['hasil_id'] > 0) {
                    $warna = ($counter % 2 == 0) ? "dark" : "light";
                    echo "<tr class='" . $warna . "'>
                    <td align=center>$no</td>
                    <td>$r[tanggal]</td>
                    <td>" . $arpkt[$r['hasil_id']] . "</td>
                    <td><span class='label label-default'>" . $r['hasil_nilai'] . "</span></td>
                    </tr>";
                    $no++;
                    $counter++;
                }
            }
            echo "</tbody></table></div>";
            ?>

            <div class="col-md-4">
                  <div class="box-body">
                      <div id="donut-chart" class="chart" style="width:100%;height:250px;"></div>
                      <div id="legend-container"></div>
                  </div>
              </div>
            </div>

            <?php
            echo "</div><div class='col-md-12'><div class='row'><div class=paging>";

            if ($offset != 0) {
                $prevoffset = $offset - $limit;
                echo "<span class=prevnext> <a href=index.php?module=riwayat&offset=$prevoffset>Back</a></span>";
            } else {
                echo "<span class=disabled>Back</span>";
            }

            $halaman = intval($baris / $limit);

            if ($baris % $limit) {
                $halaman++;
            }
            for ($i = 1; $i <= $halaman; $i++) {
                $newoffset = $limit * ($i - 1);
                if ($offset != $newoffset) {
                    echo "<a href=index.php?module=riwayat&offset=$newoffset>$i</a>";
                } else {
                    echo "<span class=current>" . $i . "</span>";
                }
            }

            if (!(($offset / $limit) + 1 == $halaman) && $halaman != 1) {
                $newoffset = $offset + $limit;
                echo "<span class=prevnext><a href=index.php?module=riwayat&offset=$newoffset>Next</a>";
            } else {
                echo "<span class=disabled>Next</span>";
            }

            echo "</div></div></div>";
        } else {
            echo "<br><b>Data Kosong !</b>";
        }
}
?>

<script>
// Grafik Donut
$(function () {
    <?php
    $arr = array();
    $hasilg = mysqli_query($conn, "SELECT hasil_id, count(hasil_id) jlh_id FROM hasil group by hasil_id ORDER BY jlh_id desc");
    while ($rg = mysqli_fetch_array($hasilg)) {
        if ($rg['hasil_id'] > 0) {
            $arr[] = array('label' => '&nbsp;' . $arpkt[$rg['hasil_id']], 'data' => array(array('Penyakit ' . $rg['hasil_id'], $rg['jlh_id'])));
        }
    }
    ?>
    var donutData = <?php echo json_encode($arr); ?>;
    var donutOptions = {
        series: {
            pie: {
                show: true,
                radius: 1,
                innerRadius: 0.3,
                label: {
                    show: true,
                    radius: 2/3,
                    formatter: function (label, series) {
                        return '<div class="badge bg-navy color-pallete">' + Math.round(series.percent) + '%</div>';
                    },
                    threshold: 0.01
                }
            }
        },
        legend: {
            show: true,
            container: $("#legend-container"),
            labelFormatter: function(label, series) {
                return '<div class="text text-primary margin4">' + label + ' ' + Math.round(series.percent) + '%';
            }
        }
    };

    $.plot('#donut-chart', donutData, donutOptions);
});
</script>
