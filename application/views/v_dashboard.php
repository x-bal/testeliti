<?php
if ($set == "dashboard") {
  $this->load->View('include/header.php');

  $jmlrfid = 0;
  $jmlalat = 0;
  $jmlmasuk = 0;
  $jmlkeluar = 0;

  if (isset($rfid)) {
    foreach ($rfid as $key => $value) {
      $jmlrfid++;
    }
  }

  if (isset($devices)) {
    foreach ($devices as $key => $value) {
      $jmlalat++;
    }
  }

  if (isset($masuk)) {
    foreach ($masuk as $key => $value) {
      $jmlmasuk++;
    }
  }

  if (isset($keluar)) {
    foreach ($keluar as $key => $value) {
      $jmlkeluar++;
    }
  }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <!-- <li class="active">Dashboard</li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-lg-12 col-xs-12">

          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <center><h3 class="box-title">Selamat datang di Beranda Sistem CAT</h3></center>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>

              <div class="container text-center" style="width:100%">
                <br>
                <img src="<?=base_url();?>asset/img/cat.png" class="img-circle" alt="User Image" height="200px" width="auto">
              </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
} 

$this->load->view('include/footer.php');
?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url();?>components/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url();?>components/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url();?>components/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>components/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url();?>components/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?=base_url();?>components/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url();?>components/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url();?>components/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url();?>components/bower_components/Chart.js/Chart.js"></script>


</body>
</html>
