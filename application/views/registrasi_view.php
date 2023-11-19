<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HAVETAMA | Registration Page</title>
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
<body class="hold-transition register-page" style="background-image: url('<?php echo base_url()?>assets/img/bg212.png');">

<div class="register-box">
    <center><img  width="70"src="<?php echo base_url()?>assets/img/logo2.png" class="img-cube" alt="width: User Image"> 
  <div class="register-logo">
 
    <a href="#" style="color: white;"><b>Havetama  Viancindo</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg"><b>Halaman Registrasi</b></p>

    <form action="<?php echo $action; ?>" method="post">
       <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nama_client" id="nama_client" placeholder="Nama Client">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat">
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="no_tlp" id="no_tlp" placeholder="Nomor Telepon">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
     
      
<div class="row">
        <div class="col-xs-8 text-left">
         <a href="<?php echo site_url('Login')?>" class="text-left">Saya Sudah Registrasi</a></div>
        <!-- /.col -->
        <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat" <?php echo $button ?>>Registrasi</button>
        </div>
      </div>


   
    </form>

    
  </div>
</div>

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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