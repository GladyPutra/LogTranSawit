<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Masuk LogTransSawit</title>
  <link rel="icon" href="<?php echo e(asset('logoa.png')); ?>"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="<?php echo e(asset('template/login/css/style.css')); ?>">  
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template/sweetalert/dist/sweetalert.css')); ?>">
  <style>
  html
  {
    background:url('<?php echo e(asset("kebun.jpg")); ?>') no-repeat center center fixed;
    -webkit-background-size:cover;
    -moz-background-size:cover;
    -o-background-size:cover;
    background-size:cover;
  }
  </style>
</head>

<body>
<div class="container">
  <div class="info">
    <h1>LogTransSawit</h1>
  </div>
</div>
<div class="form">
  <div ><img src="<?php echo e(asset('/logo.jpg')); ?>" alt="" height="200px" width="200px"/></div>
  <form action = "<?php echo e(route('login.auth')); ?>" method="post" class="login-form">
  <?php echo e(csrf_field()); ?>

    <input type="text" placeholder="Nama Pengguna" name="username" />
    <input type="password" placeholder="Kata Sandi" name="password" />
    <button>Masuk</button>
    <p class="message"><a href="<?php echo e(route('home')); ?>">Beranda</a> | <a href="<?php echo e(route('login.lupapassword')); ?>">Lupa Kata Sandi?</a> | <a href="<?php echo e(route('login.register')); ?>">Buat Akun</a></p>
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
