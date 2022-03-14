<?php
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem CAT TEST</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url(); ?>components/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>components/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(); ?>components/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>components/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url(); ?>components/plugins/iCheck/square/blue.css">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition" style="background:#0099CC">
  <div class="login-box">
    <div class="login-logo">
      <div class="login-box-body">
        <a class="text-red" href="<?= base_url(); ?>">Sistem CAT <b>TEST</b></a><br>
      </div>
      <!-- <img src="<?= base_url(); ?>components/dist/img/logo.png" width="40%" height="auto"> -->
    </div>

    <?php
    if ($flag == 'main') {
    ?>
      <div class="login-box-body">
        <p class="login-box-msg">Silahkan pilih tujuan akses</p>
        <div class="row">
          <a href="<?= base_url(); ?>login/admin">
            <button type="submit" class="btn btn-danger btn-block btn-flat">Control Panel Admin</button>
          </a><br>
          <a href="<?= base_url(); ?>login/user">
            <button type="submit" class="btn btn-danger btn-block btn-flat">Ujian Test</button>
          </a>
        </div>
      </div>
    <?php
    } else if ($flag == 'admin') {; ?>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Silahkan masukan username dan password</p>

        <!-- notifikasi -->
        <?php echo $this->session->flashdata('pesan') ?>

        <form action="<?= base_url(); ?>login/logincheck" method="post">
          <div class="form-group has-feedback">
            <input name="username" type="text" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="pass" type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input name="remember" type="checkbox"> ingat saya
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-danger btn-block btn-flat">Masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
    <?php
    } else if ($flag == 'user') {
    ?>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Silahkan masukan token untuk memulai test</p>

        <!-- notifikasi -->
        <?php echo $this->session->flashdata('pesan') ?>

        <form action="<?= base_url(); ?>ujian/tokencheck" method="post">
          <div class="form-group has-feedback">
            <input name="token" type="text" class="form-control" placeholder="Token">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-danger btn-block btn-flat">Mulai Test</button>
          </div>
        </form>
      </div>
    <?php
    }
    ?>

  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?= base_url(); ?>components/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url(); ?>components/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?= base_url(); ?>components/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
</body>

</html>