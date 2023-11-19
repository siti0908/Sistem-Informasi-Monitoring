<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT. Havetama Viancindo - Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
   <link href="<?php echo base_url() ?>assets/img/logo2.png" rel="icon">
  <link href="<?php echo base_url() ?>assets/img/logo2.png" rel="icon">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist2/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins2/iCheck/square/blue.css">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
  

<body class="hold-transition login-page " style="background-image: url('<?php echo base_url()?>assets/img/bg212.png');">

<div class="login-box">

  <div class="login-logo">
     <center><img width="80"src="<?php echo base_url()?>assets/img/logo2.png" class="img-cube" alt="width: User Image">  <br>
    <a href="#" style="color: white;"><b>Havetama  Viancindo</b></a>

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan Login Terlebih Dahulu</p>
    <?php $pesan = $this->session->flashdata('pesan');?>
        <?php if (isset($pesan)):?>
        <div class='alert alert-danger'>
            <strong>Login Salah!</strong> Username atau Password Anda Salah!
            </div>
        <?php endif?>
        <?php $status = $this->session->flashdata('status');?>
        <?php if (isset($status)):?>
        <div class='alert alert-danger'>
            <strong>Login Gagal!</strong> Akun anda belum diapprove!
            </div>
        <?php endif?>

    <form action="<?php echo site_url()?>/Login/validasi" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="username" name="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
         <a href="<?php echo site_url('user/create')?>" class="text-center">Belum punya akun? Registrasi disini</a></div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>

        </div>
        <!-- /.col -->
      </div>
      <div>
        </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/bower_components/jquery/dist2/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist2/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()?>assets/plugins2/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
