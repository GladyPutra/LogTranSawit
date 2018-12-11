<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Atur Ulang Kata Sandi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="<?php echo e(asset('template/login/css/style.css')); ?>">  
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template/sweetalert/dist/sweetalert.css')); ?>">
  <style>
  html
  {
    background:url('<?php echo e(asset('kebun.jpg')); ?>') no-repeat center center fixed;
    -webkit-background-size:cover;
    -moz-background-size:cover;
    -o-background-size:cover;
    background-size:cover;
    background: #ccc;
  }
  </style>
</head>

<body>
<div class="container">
  <div class="info">
    <h1>Atur Ulang Kata Sandi</h1>
  </div>
</div>
<div class="form">
  <form action = "<?php echo e(route('login.reset')); ?>" method="post" class="login-form">
  <?php echo e(csrf_field()); ?>

    <input type="text" placeholder="Masukkan Nama Pengguna" name="username" required />
    <button onclick="return confirm('Apakah Anda Ingin Atur Ulang Kata Sandi?');">Atur Ulang Kata Sandi</button>
  </form>
</div>
<video id="video" autoplay="autoplay" loop="loop" poster="polina.jpg">
  <source src="http://andytran.me/A%20peaceful%20nature%20timelapse%20video.mp4" type="video/mp4"/>
</video>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>
  <script src="<?php echo e(asset('template/sweetalert/sweetalert.js')); ?>"></script>
  <?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>
