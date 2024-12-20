<title>SISTEM PAKAR AYAM</title>
<style>
  .small-box {
      min-height: 150px; 
  }
  .small-box .inner {
        display: flex;
        flex-direction: column;
        justify-content: center;  /* Vertikal tengah */
        align-items: flex-start;  /* Horizontal kiri */
        text-align: left;         /* Teks diatur kiri */
        padding-left: 20px;       /* Memberikan jarak kiri */
    }
  .small-box .inner p {
        font-size: 22px; 
  }
  .bg-pink {
      background: linear-gradient(135deg, #ff69b4, #ffb6c1); /* Gradasi pink */
      color: #fff; /* Teks berwarna putih */
  }
  .bg-purple {
      background: linear-gradient(135deg, #800080, #dda0dd); /* Gradasi ungu */
      color: #fff; /* Teks berwarna putih */
  }
  .bg-pastel-red {
      background: linear-gradient(135deg, #ff6f61, #ffa07a); /* Gradasi merah pastel */
      color: #fff; /* Teks berwarna putih */
  }
  

</style>
<div>
  <?php 
    $htgejala=mysqli_query($conn,"SELECT count(*) as total from gejala");
    $dtgejala=mysqli_fetch_assoc($htgejala); ?>
    <div class='row'>
          <div class='col-lg-4 col-xs-8'>
            <div class='small-box bg-pink'>
              <div class='inner'>
                <h3> <?php echo $dtgejala["total"]; ?></h3>
                <p>Total Gejala</p>
              </div>
              <div class='icon'>
                <i class='ion ion-thermometer'></i>
              </div>
            </div>
          </div>

  <?php 
    $htpenyakit=mysqli_query($conn,"SELECT count(*) as total from penyakit");
      $dtpenyakit=mysqli_fetch_assoc($htpenyakit); ?>
          <div class="col-lg-4 col-xs-8">
            <div class="small-box bg-purple">
              <div class="inner">
                <h3> <?php echo $dtpenyakit["total"]; ?></h3>
                <p>Total Penyakit</p>
              </div>
              <div class="icon">
                <i class="ion ion-bug"></i>
              </div>
            </div>
          </div>

  <?php 
    $htpengetahuan=mysqli_query($conn,"SELECT count(*) as total from basis_pengetahuan");
      $dtpengetahuan=mysqli_fetch_assoc($htpengetahuan); ?>
          <div class="col-lg-4 col-xs-8">
            <div class="small-box bg-pastel-red">
              <div class="inner">
                <h3><?php echo $dtpengetahuan["total"]; ?></h3>
                <p>Total Pengetahuan</p>
              </div>
              <div class="icon">
                <i class="ion ion-erlenmeyer-flask"></i>
              </div>
            </div>
          </div>

</div>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="aset/banner/jago 1.png" alt="First slide">
                    <div class="carousel-caption">
                    </div>
                  </div>
                  <div class="item">
                    <img src="aset/banner/jago 2.png" alt="Second slide">
                    <div class="carousel-caption">
                    </div>
                  </div>
                </div> 
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
			  <br>
           
