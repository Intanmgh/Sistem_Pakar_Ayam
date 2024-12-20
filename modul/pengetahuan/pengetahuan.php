<?php
include "config/fungsi_alert.php";
$aksi = "modul/pengetahuan/aksi_pengetahuan.php";
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$limit = 15;

// Cek parameter 'act' untuk menentukan aksi yang akan dilakukan
$act = isset($_GET['act']) ? $_GET['act'] : '';

switch ($act) {
    // Default: Menampilkan basis pengetahuan
    default:
        // Form pencarian
        echo "<form method='POST' action='?module=pengetahuan' name='text_form' onsubmit='return Blank_TextField_Validator_Cari()'>
            <br><br><table class='table table-bordered'>
            <input type='text' name='keyword' style='margin-left: 10px;' placeholder='Ketik dan tekan cari...' class='form-control' value='".(isset($_POST['keyword']) ? $_POST['keyword'] : '')."' /> 
            <input class='btn bg-olive margin' type='submit' value='   Cari   ' name='Go'></td> </tr>
            </table></form>";

        // Jika tombol cari ditekan
        if (isset($_POST['Go'])) {
            // Query untuk mencari berdasarkan nama penyakit
            $numrows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM basis_pengetahuan b, penyakit p WHERE b.kode_penyakit = p.kode_penyakit AND p.nama_penyakit LIKE '%".$_POST['keyword']."%'"));
            if ($numrows > 0) {
                echo "<div class='alert alert-success alert-dismissible'>
                    <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                    Pengetahuan yang anda cari ditemukan.
                  </div>";

                echo "<table class='table table-bordered'>
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Penyakit</th>
                          <th>Gejala</th>
                          <th>MB</th>
                          <th>MD</th>
                        </tr>
                      </thead>
                      <tbody>";

                // Query untuk mengambil data berdasarkan pencarian
                $hasil = mysqli_query($conn, "SELECT b.kode_pengetahuan, p.nama_penyakit, g.nama_gejala, b.mb, b.md 
                                             FROM basis_pengetahuan b
                                             JOIN penyakit p ON b.kode_penyakit = p.kode_penyakit
                                             JOIN gejala g ON b.kode_gejala = g.kode_gejala
                                             WHERE p.nama_penyakit LIKE '%".$_POST['keyword']."%'");
                $no = 1;
                $counter = 1;

                // Menampilkan hasil pencarian
                while ($r = mysqli_fetch_array($hasil)) {
                    $warna = ($counter % 2 == 0) ? "dark" : "light";

                    // Debugging untuk memastikan data ada
                    if (!isset($r['nama_penyakit']) || !isset($r['nama_gejala'])) {
                        echo "Data tidak ditemukan!";
                        continue;
                    }

                    echo "<tr class='$warna'>
                        <td align='center'>$no</td>
                        <td>$r[nama_penyakit]</td>
                        <td>$r[nama_gejala]</td>
                        <td align='center'>$r[mb]</td>
                        <td align='center'>$r[md]</td>
                  
                    </tr>";
                    $no++;
                    $counter++;
                }
                echo "</tbody></table>";
            } else {
                // Jika tidak ada hasil pencarian
                echo "<div class='alert alert-danger alert-dismissible'>
                    <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                    Maaf, Pengetahuan yang anda cari tidak ditemukan, silahkan inputkan dengan benar dan cari kembali.
                  </div>";
            }
        } else {
            // Jika tidak ada pencarian, tampilkan data default
            $tampil = mysqli_query($conn, "SELECT b.kode_pengetahuan, p.nama_penyakit, g.nama_gejala, b.mb, b.md 
                                          FROM basis_pengetahuan b
                                          JOIN penyakit p ON b.kode_penyakit = p.kode_penyakit
                                          JOIN gejala g ON b.kode_gejala = g.kode_gejala
                                          ORDER BY b.kode_pengetahuan");
            $baris = mysqli_num_rows($tampil);

            // Menampilkan data default (semua data basis pengetahuan)
            echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Penyakit</th>
                        <th>Gejala</th>
                        <th>MB</th>
                        <th>MD</th>
                    </tr>
                </thead>
                <tbody>";

            $no = 1;
            $counter = 1;
            while ($r = mysqli_fetch_array($tampil)) {
                $warna = ($counter % 2 == 0) ? "dark" : "light";

                // Debugging untuk memastikan data ada
                if (!isset($r['nama_penyakit']) || !isset($r['nama_gejala'])) {
                    echo "Data tidak ditemukan!";
                    continue;
                }

                echo "<tr class='$warna'>
                    <td align='center'>$no</td>
                    <td>$r[nama_penyakit]</td>
                    <td>$r[nama_gejala]</td>
                    <td align='center'>$r[mb]</td>
                    <td align='center'>$r[md]</td>
                   
                </tr>";
                $no++;
                $counter++;
            }
            echo "</tbody></table>";
        }
        break;
}
?>
