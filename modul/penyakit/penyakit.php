<?php
include "config/fungsi_alert.php";

$aksi = "modul/penyakit/aksi_penyakit.php";

$act = $_GET['act'] ?? '';  
$offset = $_GET['offset'] ?? 0;  

$keyword = $_POST['keyword'] ?? '';

switch ($act) {
    default:
        $limit = 15;
        $tampil = mysqli_query($conn, "SELECT * FROM penyakit ORDER BY kode_penyakit");

        echo "<form method='POST' action='?module=penyakit' name='text_form' onsubmit='return Blank_TextField_Validator_Cari()'>
                <br><br>
                <table class='table table-bordered'>
                    <tr>
                        <td>
                            <input type='text' name='keyword' style='margin-left: 10px;' placeholder='Ketik dan tekan cari...' class='form-control' value='$keyword' /> 
                            <input class='btn bg-olive margin' type='submit' value='   Cari   ' name='Go' style='background-color: #ce0606 !important; border-color: #b00505 !important; color: #fff !important;'>
                        </td>
                    </tr>
                </table>
              </form>";

        $baris = mysqli_num_rows($tampil);

        if (isset($_POST['Go'])) {
            $keyword = mysqli_real_escape_string($conn, $_POST['keyword']); 
            $numrows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penyakit WHERE nama_penyakit LIKE '%$keyword%'"));
            if ($numrows > 0) {
                echo "<div class='alert alert-success alert-dismissible'>
                        <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                        Penyakit yang anda cari ditemukan.
                      </div>";
                echo "<table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penyakit</th>
                                <th>Detail Penyakit</th>
                                <th>Saran Penyakit</th>
                            </tr>
                        </thead>
                        <tbody>";
                $hasil = mysqli_query($conn, "SELECT * FROM penyakit WHERE nama_penyakit LIKE '%$keyword%'");
                $no = 1;
                while ($r = mysqli_fetch_array($hasil)) {
                    $warna = ($no % 2 == 0) ? 'dark' : 'light';
                    echo "<tr class='$warna'>
                            <td align='center'>$no</td>
                            <td>$r[nama_penyakit]</td>
                            <td>$r[det_penyakit]</td>
                            <td>$r[srn_penyakit]</td>
                        </tr>";
                    $no++;
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible'>
                        <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                        Penyakit yang anda cari tidak ditemukan.
                      </div>";
            }
        } else {
            $hasil = mysqli_query($conn, "SELECT * FROM penyakit ORDER BY kode_penyakit LIMIT $offset, $limit");
            if ($baris > 0) {
                echo "<table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penyakit</th>
                                <th>Detail Penyakit</th>
                                <th>Saran Penyakit</th>
                                
                            </tr>
                        </thead>
                        <tbody>";
                $no = 1 + $offset;
                while ($r = mysqli_fetch_array($hasil)) {
                    $warna = ($no % 2 == 0) ? 'dark' : 'light';
                    echo "<tr class='$warna'>
                            <td align='center'>$no</td>
                            <td>$r[nama_penyakit]</td>
                            <td>$r[det_penyakit]</td>
                            <td>$r[srn_penyakit]</td>
                           
                        </tr>";
                    $no++;
                }
                echo "</tbody></table>";
            } else {
                echo "<br><b>Data Kosong !</b>";
            }
        }
        break;

    case "tambahpenyakit":
        // Form tambah penyakit
        break;

    case "editpenyakit":
        // Form edit penyakit
        break;
}
?>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#upload").change(function() {
        readURL(this);
    });
</script>
