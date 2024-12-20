<?php
// Default value for 'keyword' if not set
$keyword = isset($_POST['keyword']) ? mysqli_real_escape_string($conn, $_POST['keyword']) : '';
?>
<title>Gejala - Chirexs 1.0</title>
<?php
$aksi = "aksi_gejala.php";  
?>

<script type="text/javascript">
function Blank_TextField_Validator()
{
  if (document.forms['text_form'].nama_gejala.value == "")
  {
    alert("Nama Gejala tidak boleh kosong!");
    document.forms['text_form'].nama_gejala.focus();
    return false;
  }
  return true;
}

function Blank_TextField_Validator_Cari()
{
  if (document.forms['text_form'].keyword.value == "")
  {
    alert("Isi dulu keyword pencarian !");
    document.forms['text_form'].keyword.focus();
    return false;
  }
  return true;
}
</script>

<?php
include "config/fungsi_alert.php";

// Cek apakah 'act' ada di $_GET
$act = isset($_GET['act']) ? $_GET['act'] : '';  // Jika tidak ada, set default ke ''
switch ($act) {
    // Tampil gejala
    default:
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $limit = 15;

        $tampil = mysqli_query($conn, "SELECT * FROM gejala ORDER BY kode_gejala");
        echo "<form method='POST' action='?module=gejala' name='text_form' onsubmit='return Blank_TextField_Validator_Cari()'>
                <br><br><table class='table table-bordered'>
                <input type='text' name='keyword' style='margin-left: 10px;' placeholder='Ketik dan tekan cari...' class='form-control' value='{$keyword}' /> 
                <input class='btn bg-olive margin' type='submit' value='Cari' name='Go' style='background-color: #ce0606 !important; border-color: #b00505 !important; color: #fff !important;'></td></tr>
                </table></form>";
        
        $baris = mysqli_num_rows($tampil);

        if (isset($_POST['Go'])) {
            $keyword = isset($_POST['keyword']) ? mysqli_real_escape_string($conn, $_POST['keyword']) : '';  // Cek apakah keyword ada
            $numrows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM gejala WHERE nama_gejala LIKE '%$keyword%'"));
            if ($numrows > 0) {
                echo "<div class='alert alert-success alert-dismissible'>
                        <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                        Gejala yang anda cari ditemukan.
                      </div>";
                echo "<table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Gejala</th>
                            </tr>
                        </thead>
                        <tbody>"; 
                $hasil = mysqli_query($conn, "SELECT * FROM gejala WHERE nama_gejala LIKE '%$keyword%'");
                $no = 1;
                $counter = 1;
                while ($r = mysqli_fetch_array($hasil)) {
                    $warna = ($counter % 2 == 0) ? "dark" : "light";
                    echo "<tr class='{$warna}'>
                            <td align='center'>{$no}</td>
                            <td>{$r['nama_gejala']}</td>
                          </tr>";
                    $no++;
                    $counter++;
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible'>
                        <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                        Maaf, Gejala yang anda cari tidak ditemukan. Silakan inputkan dengan benar dan coba kembali.
                      </div>";
            }
        } else {
            if ($baris > 0) {
                echo "<table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Gejala</th>
                            </tr>
                        </thead>
                        <tbody>"; 
                $hasil = mysqli_query($conn, "SELECT * FROM gejala ORDER BY kode_gejala LIMIT $offset, $limit");
                $no = $offset + 1;
                $counter = 1;
                while ($r = mysqli_fetch_array($hasil)) {
                    $warna = ($counter % 2 == 0) ? "dark" : "light";
                    echo "<tr class='{$warna}'>
                            <td align='center'>{$no}</td>
                            <td>{$r['nama_gejala']}</td>
                            
                          </tr>";
                    $no++;
                    $counter++;
                }
                echo "</tbody></table>";
                // Pagination code continues here
            } else {
                echo "<br><b>Data Kosong!</b>";
            }
        }
    break;
    // Other cases like tambahgejala and editgejala remain unchanged
}
?>
