<?php $__env->startSection('custom_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	PENGELOLAAN AKUN PEGAWAI
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
        <!--  -->
        </div>
        <div class="col-lg-6">

        </div>

        <div class="panel-body">
                <div class="col-sm-4 col-xs-8 form-group">
                    <!-- <a href="" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a> -->
                    <a href="<?php echo e(route('pegawai.tampil')); ?>" class="btn btn-success"><i class="fa fa-refresh"></i> Refresh</a>

                </div>
                <?php echo Form::open(['method'=>'GET','url'=>'/pegawai/cari']); ?>

                <div class="col-sm-4 col-xs-8 form-group pull-right input-group">
                    <input type="text" name="katakunci" class="form-control" placeholder="Pencarian...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                <?php echo Form::close(); ?>

								<div class="row">
									<table id="tables" class="table table-striped table-bordered table-hover" id="dataTables-example">
											<thead>
											<tr>
													<th>NAMA PEGAWAI</th>
													<th>EMAIL</th>
													<th>NOMOR HP</th>
													<th>ROLE</th>
													<th>KONTROL</th>
											</tr>
											</thead>
											<?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tbody>
											<tr>
													<td><?php echo e($data->nama); ?></td>
													<td><?php echo e($data->email); ?></td>
													<td><?php echo e($data->no_hp); ?></td>
													<td><?php echo e($data->role['deskripsi']); ?></td>
													<td width="250px">
															<form method="POST" action="<?php echo e(route('pegawai.hapus', $data->id_user)); ?>" accept-charset="UTF-8">
																<input name="_method" type="hidden" value="DELETE">
																<input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
																	<a href="<?php echo e(route('pegawai.ubah', $data->id_user)); ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Ubah</a>
																	<a href="<?php echo e(route('pegawai.resetpassword', $data->id_user)); ?>" class="btn btn-primary btn-xs"
																	onclick="return confirm('Apakah Anda Yakin Ingin Reset Password?');" ><i class="fa fa-key"></i> Reset Password</a>
																	<input type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda Ingin Menghapus Akun Pengguna?');" value="Hapus">
															</form>
													</td>
											</tr>
											</tbody>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</table>
								</div>
                <div class="table-responsive">
                <?php if($user->count()): ?>

                </div>
                <?php echo $user->links(); ?>

                <?php else: ?>
                <div class="alert">
                    <i class="fa fa-exclamation-triangle"></i> Data Tidak Tersedia...
                </div>
                <?php endif; ?>
            </div>
        <div class="col-sm-12">
                <table class="table table-striped table-bordered" id="dataTables-example">
                <form class="form_isi" action="" method="post" role="form">

                    <thead>
                        <tr>
                            <th colspan="2">Kelola Akun</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="200px">USERNAME</td>
                            <?php if(isset($dataUser)): ?>
                                 <td><input id="txtuseredit" value="<?php echo e($dataUser->username); ?>" type="text" class="form-control" name="username" placeholder="Masukkan Nama "/>

                                 </td>
                            <?php else: ?>
                                <td><input id="txtusersimpan" value="" type="text" class="form-control" name="username" placeholder="Masukkan Username "></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td width="200px">PASSWORD</td>
                            <td><input type="password"class="form-control" name="password" placeholder="Masukkan Password"
                                value="<?php if($dataUser!=null) echo $dataUser->password; else ""; ?>" required></td>
                        </tr>
                        <tr>
                            <td width="200px">NAMA</td>
                            <td><input type="text"class="form-control" name="nama" placeholder="Masukkan Nama Lengkap"
                                value="<?php if($dataUser!=null) echo $dataUser->nama; else ""; ?>" required></td>
                        </tr>
                        <tr>
                            <td width="200px">EMAIL</td>
                            <td><input type="text"class="form-control" name="email" placeholder="Masukkan Email"
                                value="<?php if($dataUser!=null) echo $dataUser->email; else ""; ?>" required></td>
                        </tr>
                        <tr>
                            <td width="200px">NOMOR HP</td>
                            <td><input type="text"class="form-control" name="no_hp" placeholder="Masukkan Nomor HP"
                                value="<?php if($dataUser!=null) echo $dataUser->no_hp; else ""; ?>" required></td>
                        </tr>
                        <tr>
                            <td width="200px">ROLE</td>
                            <td><select class="form-control" name="role">
                                    <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($data->id_role); ?>" <?php if($dataUser!=null&&$dataUser->id_role == $data->id_role) echo "Selected";?>><?php echo e($data->deskripsi); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select></td>
                        </tr>

                        <?php echo e(csrf_field()); ?>

                    </tbody>
                     <table>
                            <?php if(isset($flag) && isset($dataUser)): ?>
                                <td>&emsp;<button class="btn btn-primary btnedit" value="<?php echo e(route('pegawai.doedit',$dataUser->id_user)); ?>">Simpan</button></td>

                            <?php else: ?>
                                <td>&emsp;<button class="btn btn-primary btnsimpan" value="<?php echo e(route('pegawai.simpan')); ?>">Simpan</button></td>
                            <?php endif; ?>

                            <td>&emsp;<a href="<?php echo e(route('pegawai.tampil')); ?>" class="btn btn-danger">Batal</a></td>
                        </table>
                    </form>
                </table>
                </div>
    </div>
</div>
    <script src="<?php echo e(asset('template/admin/plugins/jquery-1.10.2.js')); ?>"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
    }
});

$('.btnedit').click(function(e){
    e.preventDefault();
    $.ajax({
        type: 'get',
        url : '../../username-exist/'+$("#txtuseredit").val(),
        success : function(data){

                $('.form_isi').attr('action',$(".btnedit").val());
                $('.form_isi').append('<?php echo e(method_field("PATCH")); ?>');
                $('.form_isi').submit();
        }
    });
});
$('.btnsimpan').click(function(e){
    e.preventDefault();
    $.ajax({
        type: 'get',
        url : 'username-exist/'+$("#txtusersimpan").val(),
        success : function(data){
            if(data == "sukses")
            {
                $('.form_isi').attr('action',$(".btnsimpan").val());
                $('.form_isi').submit();
            }
            else
            {
                alert("Username Sudah Ada !")
            }
            // if(data == "sukses")
            // {
            //     alert("Username udah ada")
            // }
            // else
            // {
            //      $('.form_isi').attr('action',$(this).val());
            //     $('.form_isi').submit();
            // }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>