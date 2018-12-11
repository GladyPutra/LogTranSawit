<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Daftar LogTranSawit</title>
  <link rel="icon" href="logo3.png"/>
  <link href="<?php echo e(asset('template/admin/plugins/bootstrap/bootstrap.css')); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="<?php echo e(asset('template/login/css/style.css')); ?>">  
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template/sweetalert/dist/sweetalert.css')); ?>">
  <style>
  html
  {
    background:url('kebun.jpg') no-repeat center center fixed;
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
    <h1>Daftar Akun LogTranSawit</h1>
  </div>
</div>
<div class="form">
  <form action = "<?php echo e(route('login.daftar')); ?>" method="post" class="login-form">
  <?php echo e(csrf_field()); ?>

    <input type="text" placeholder="Username" name="username" required />
    <input type="password" placeholder="Password" name="password" required  />
    <input type="password" placeholder="Konfirmasi Password" name="konfirmasi" required  />
    <input type="text" placeholder="Nama Lengkap" name="nama" required />
    <input type="text" placeholder="Email" name="email" required />
    <input type="text" placeholder="Nomor HP" name="no_hp" required />
    <select class="form-control" name="role">
      <?php $__currentLoopData = \App\Role::where('id_role','<>',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($role->id_role); ?>"><?php echo e($role->deskripsi); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br/>
    <button>Daftar</button>
    <p class="message"><a href="<?php echo e(route('home')); ?>">Beranda</a> | <a href="<?php echo e(route('login.home')); ?>">Login</a></p>
  </form>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>
  <script src="<?php echo e(asset('template/sweetalert/sweetalert.js')); ?>"></script>
  <?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>
