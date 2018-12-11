<?php $__env->startSection('custom_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
PETA
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(Session::has('error')): ?>
    <div class="alert alert-danger alert-call">
        <p><?php echo e(Session::get('error')); ?></p>
    </div>
<?php endif; ?>
<div class="row">
	<div class="col-lg-12">
	<?php if(count($errors)>0): ?>
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <li class="alert alert-danger"><?php echo e($error); ?></li>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
	<?php endif; ?>
		<!-- Advanced Tables -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<!--  -->
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3 form-group">
						<button class="tbhafdelingshow btn btn-primary btn-md btn-block">Menu Tambah Afdeling</button>
					</div>
					<div class="col-md-2 form-group">
						<button class="tbhblokshow btn btn-primary btn-md btn-block">Menu Tambah Blok</button>
					</div>
          <div class="col-md-2 form-group">
            <button class="tbhtphshow btn btn-primary btn-md btn-block">Menu Tambah TPH</button>
          </div>
					<div class="col-md-2 form-group">
						<button class="hapusshow btn btn-danger btn-md btn-block">Menu Hapus</button>
					</div>
				</div>
				<div class="menuhapus" style="display:none">
					<div class="row">
					<h3 style="margin-left:15px">Hapus Peta Afdeling</h3>
						<form id="hapusafdeling" action="<?php echo e(route('deleteafdeling')); ?>" method="post">
							<?php echo e(csrf_field()); ?>

							<?php echo e(method_field('delete')); ?>

							<div class="form-group col-md-3">
							<label>Pilih Afdeling</label>
									<select class="form-control afd-pilih-1" name="afd">
										<?php $__currentLoopData = \App\Afdeling::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $af): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($af->id_afdeling); ?>"><?php echo e($af->deskripsi); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
							</div>
							<br/>
							<div class="form-group">
								<button id="submithapus" class="btn btn-primary btn-danger">Hapus Afdeling</button>
							</div>
						</form>
					</div>
					<div class="row">
					<h3 style="margin-left:15px">Hapus Peta Blok</h3>
						<form id="hapusblok" action="<?php echo e(route('hapusblok')); ?>" method="post">
							<?php echo e(csrf_field()); ?>

							<?php echo e(method_field('delete')); ?>

							<div class="form-group col-md-3">
							<label>Pilih Afdeling</label>
									<select class="form-control afd-pilih-2" name="afd">
										<?php $__currentLoopData = \App\Afdeling::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $af): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($af->id_afdeling); ?>"><?php echo e($af->deskripsi); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
							</div>
							<div class="form-group col-md-3">
							<label>Pilih Blok</label>
								<div id="displaybloklist">
									<select class="form-control" name="blok">
									  <?php $__currentLoopData = \App\Blok::where('id_afdeling',\App\Afdeling::min('id_afdeling'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									    <option value="<?php echo e($blok->id_blok); ?>"><?php echo e($blok->deskripsi); ?></option>
									  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
							<br/>
							<div class="form-group">
								<button id="submithapusblok" class="btn btn-primary btn-danger">Hapus Blok</button>
							</div>
						</form>
					</div>
					<div class="row">
					    <h3 style="margin-left:15px">Hapus TPH</h3>
						<form id="hapustph" action="<?php echo e(route('deletetph')); ?>" method="post">
							<?php echo e(csrf_field()); ?>

							<?php echo e(method_field('delete')); ?>

							<div class="form-group col-md-3">
							<label>Pilih Afdeling</label>
									<select class="form-control pilih-afd" name="afd">
										<?php $__currentLoopData = \App\Afdeling::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $af): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($af->id_afdeling); ?>"><?php echo e($af->deskripsi); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
							</div>
							<div class="displaybloklist1">
							    <div class="form-group col-md-3">
							<label>Pilih Blok</label>
									<select class="form-control pilih-blok" name="blok">
										<?php $__currentLoopData = \App\Blok::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $af): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($af->id_blok); ?>"><?php echo e($af->deskripsi); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
							</div>
							</div>
							<div class="form-group col-md-3">
							<label>Pilih TPH</label>
								<div id="displaytphlist">
									<select class="form-control" name="id">
									  <?php $__currentLoopData = \App\TPH::where('id_blok',\App\Blok::min('id_blok'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									    <option value="<?php echo e($blok->tph); ?>"><?php echo e($blok->deskripsi); ?></option>
									  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
							<br/>
							<div class="form-group">
								<button id="submithapusblok" class="btn btn-primary btn-danger">Hapus TPH</button>
							</div>
						</form>
					   </div>
				</div>

        <!-- Tambah Afdeling -->
				<hr style="width:100%;color:black;"/>
				<div class="menutbhafdeling" style="display:none">
					<div class="row">
						<h3 style="margin-left:15px">Tambah Peta Afdeling</h3>
						<form id="formtambahpeta" action="<?php echo e(route('afdeling.simpan')); ?>" method="post">
						<?php echo e(csrf_field()); ?>

						<div class="col-md-12 form-group">
							<div class="col-md-1">
							<label>Warna</label>
							<input type="color" name="favcolor" value="#ff0000" class="form-control" required>
							</div>
						</div>
						<div class="col-md-12 form-group">
						<div class="col-md-12 form-group">
							<label>Deskripsi</label>
							<input type="text" class="form-control" name="deskripsi" required/>
						</div>
						<div class="col-md-4 form-group">
							<label>Assisten Pengelola</label>
							<!-- <input type="text" class="form-control" id="pengelola" name="pengelola"/> -->
							<select class="form-control" name="pengelola">
								<option value="0">---Pilih assisten---</option>
								<?php $__currentLoopData = \App\User::where("id_role",3)->orWhere("id_role",2)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($ast->id_user); ?>"><?php echo e($ast->username); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<input type="text" style="display:none" name="coord" id="coord" required/>
						<div class="col-md-12 form-group">
							<a class="btn btn-sm btn-danger" id="clear_shapes">Bersihkan Bentuk</a>
							<button class="btn btn-sm btn-success" id="btnsimpan"><i class="fa fa-save fa-fw"></i>Simpan</button>
						</div>
						</form>
					</div>

					</div>
				</div>

        <!-- Tambah Blok -->
				<hr style="width:100%;color:black;"/>
				<div class="menutbhblok" style="display:none">
					<div class="row">
						<h3 style="margin-left:15px">Tambah Blok</h3>
						<form id="formtambahpetablok" action="<?php echo e(route('tambahblok')); ?>" method="post">
						<?php echo e(csrf_field()); ?>

						<div class="col-md-12 form-group">
						<div class="col-md-3">
							<label>Pilih Afdeling</label>
							<select class="form-control" name="afdeling">
								<option value="0">-----Pilh Afdeling-----</option>
								<?php $__currentLoopData = \App\Afdeling::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $af): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option style="color:<?php echo e($af->warna); ?>" value="<?php echo e($af->id_afdeling); ?>">id : <?php echo e($af->deskripsi); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="col-md-12 form-group">
							<label>Deskripsi</label>
							<input type="text" class="form-control" name="deskripsi"/>
						</div>
						<div class="col-md-12 form-group">
							<label>Krani</label>
							<select class="form-control" name="pengelola">
								<option value="0">---Pilih krani---</option>
								<?php $__currentLoopData = \App\User::where("id_role",7)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($ast->id_user); ?>"><?php echo e($ast->username); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="col-md-12 form-group">
							<label>Hari Panen</label>
							<select class="form-control" name="hari">
								<option value="Senin">Senin</option>
								<option value="Selasa">Selasa</option>
								<option value="Rabu">Rabu</option>
								<option value="Kamis">Kamis</option>
								<option value="Jumat">Jumat</option>
								<option value="Sabtu">Sabtu</option>
								<option value="Minggu">Minggu</option>
							</select>
						</div>
						<div class="col-md-3 form-group">
							<label>Jumlah Pohon</label>
							<input type="number" class="form-control" name="jumlahpohon"/>
						</div>
						<input type="text" style="display:none" name="coord" id="coordblok"/>
						<div class="col-md-12 form-group">
							<a class="btn btn-sm btn-danger" id="clear_shapes2">Bersihkan Bentuk</a>
							<button class="btn btn-sm btn-success" id="btnsimpanblok"><i class="fa fa-save fa-fw"></i>Simpan</button>
							<br/>
							<hr style="color:black;width100%"/>
						</div>
						</form>
					</div>

					</div>
				</div>

        <!-- Tambah TPH -->
        <hr style="width:100%;color:black;"/>
        <div class="menutbhtph" style="display:none">
          <div class="row">
            <h3 style="margin-left:15px">Tambah TPH</h3>
            <form id="formtambahpetatph" action="<?php echo e(route('tambahtph')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="col-md-12 form-group">
            <div class="col-md-3">
              <label>Pilih Blok</label>
              <select class="form-control" name="blok">
                <option value="0">-----Pilh Blok-----</option>
                <?php $__currentLoopData = \App\Blok::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $af): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($af->id_blok); ?>">id : <?php echo e($af->deskripsi); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="col-md-12 form-group">
              <label>Deskripsi</label>
              <input type="text" class="form-control" name="deskripsi"/>
            </div>
            <div class="col-md-3 form-group">
              <label>Jumlah Kapasitas</label>
              <input type="number" class="form-control" name="kapasitas"/>
            </div>
            <div class="col-md-3 form-group">
              <label>Jumlah Panen</label>
              <input type="number" class="form-control" name="panen"/>
            </div>
            <input type="text" style="display:none" name="coord" id="coordtph"/>
            <div class="col-md-12 form-group">
              <a class="btn btn-sm btn-danger" id="clear_shapes3">Bersihkan Bentuk</a>
              <button class="btn btn-sm btn-success" id="btnsimpantph"><i class="fa fa-save fa-fw"></i>Simpan</button>
              <br/>
              <hr style="color:black;width100%"/>
            </div>
            </form>
          </div>

          </div>
        </div>
			<div class="row">
				<div class="col-md-12 form-group">
					<div id="map" style="width:100%;height:500px"></div>
				</div>
			</div>

		</div>
		<form>

		</form>
		<!--End Advanced Tables -->
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_script'); ?>
<script>
<?php $data = \App\User::where("id_role",3)->pluck("username")->toArray(); ?>
var assisten = <?php echo json_encode($data)?>;

$(".hapusshow").click(function(){
	$(".menuhapus").slideToggle();
})

$(".tbhafdelingshow").click(function(){
	$(".menutbhafdeling").slideToggle();
});

$(".tbhblokshow").click(function(){
	$(".menutbhblok").slideToggle();
});

$(".tbhtphshow").click(function(){
  $(".menutbhtph").slideToggle();
});

// $("#pengelola").autocomplete({
// 	source:assisten
// });
</script>
<script>
	var map;
	var shapes = [];
	var selected_shape=null;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -1.266336, lng: 119.447592},
			zoom: 15
		});

		byId = function(s){return document.getElementById(s)};
		setSelection  = function(shape){
			clearSelection();
			selected_shape=shape;

			selected_shape.set((selected_shape.type
				===
				google.maps.drawing.OverlayType.MARKER
				)?'draggable':'editable',true);

		};
		clearSelection = function(){
			if(selected_shape){
				selected_shape.set((selected_shape.type
					===
					google.maps.drawing.OverlayType.MARKER
					)?'draggable':'editable',false);
				selected_shape = null;
			}
		};
		clearShapes = function(){
			for(var i=0;i<shapes.length;++i){
				shapes[i].setMap(null);
			}
			shapes=[];
			var data=IO.IN(shapes,false);byId('data').value=JSON.stringify(data);
		};

		var drawingManager = new google.maps.drawing.DrawingManager({
			drawingMode: null,
			drawingControl: true,
			drawingControlOptions: {
				position: google.maps.ControlPosition.TOP_CENTER,
				drawingModes: ['marker','polygon']
			},
			markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
			circleOptions: {
				fillColor: '#ffff00',
				fillOpacity: 1,
				strokeWeight: 5,
				clickable: false,
				editable: true,
				zIndex: 1
			}
		});
		drawingManager.setMap(map);

		google.maps.event.addListener(drawingManager,'overlaycomplete',function(e)
		{
			var shape   = e.overlay;
			shape.type  = e.type;
			google.maps.event.addListener(shape, 'click', function() {
				setSelection(this);
			});
			setSelection(shape);
			shapes.push(shape);
    //var data=IO.IN(shapes,false);byId('data').value=JSON.stringify(data);
		});
		google.maps.event.addDomListener(byId('clear_shapes'), 'click', clearShapes);
		google.maps.event.addDomListener(byId('clear_shapes2'), 'click', clearShapes);
    google.maps.event.addDomListener(byId('clear_shapes3'), 'click', clearShapes);

		<?php foreach(\App\Afdeling::all() as $afd): ?>
		var wilayahafd = IO.OUT((JSON.parse(<?php echo json_encode($afd->koordinat)?>)),map,'<?php echo e($afd->warna); ?>');
		var shapeafd = wilayahafd[0];
		var infowindow = new google.maps.InfoWindow();

		google.maps.event.addListener(shapeafd, 'click', function(e) {
			infowindow.setPosition(e.latLng);
			infowindow.setContent(
				"<h5><strong>INFORMASI AFDELING</strong></h5>"+
				"<table class='table'>"+
				"<tr>"+
				"<td>Nama Assisten Kebun</td><td>:</td><td><?php echo e(\App\User::where('id_user',$afd->id_user)->pluck('nama')->first()); ?></td>"+
				"</tr>"+
				"<tr>"+
				"<td>ID Afdeling</td><td>:</td><td><?php echo e($afd->id_afdeling); ?></td>"+
				"</tr>"+
				"<tr>"+
				"<td>Deskripsi</td><td>:</td><td><?php echo e($afd->deskripsi); ?></td>"+
				"</tr>"+
				"<tr>"+
				"<td>Jumlah Pohon</td><td>:</td><td><?php echo e(number_format( $afd->jumlah_pohon, 0 , '.' , ',' )); ?></td>"+
				"</tr>"+
				"<tr>"+
				"<td>Luas Afdeling</td>"+
				"<td>:</td><td>"+IO.OUT_luas((JSON.parse(<?php echo json_encode($afd->koordinat)?>)),map,"")+"</td></tr>"+
				"</table>"+
				"<td></td>");
			infowindow.open(map);
		});
		<?php endforeach; ?>
		<?php foreach(\App\Blok::all() as $afd): ?>
		var wilayah = IO.OUT((JSON.parse(<?php echo json_encode($afd->koordinat)?>)),map,'<?php echo e($afd->warna); ?>');
		var shape = wilayah[0];
		var infowindow = new google.maps.InfoWindow();

		google.maps.event.addListener(shape, 'click', function(e) {
			infowindow.setPosition(e.latLng);
			infowindow.setContent(
				"<h5><strong>INFORMASI BLOK</strong></h5>"+
				"<table class='table'>"+
				"<tr>"+
				"<td>Nama Krani</td><td>:</td><td><?php echo e(\App\User::where('id_user',\App\Krani::where('id_blok',$afd->id_blok)->pluck('id_user')->first())->pluck('nama')->first()); ?></td>"+
				"</tr>"+
				"<tr>"+
				"<td>ID Afdeling</td><td>:</td><td><?php echo e($afd->id_afdeling); ?></td>"+
				"</tr>"+
				"<tr>"+
				"<td>ID Blok</td><td>:</td><td><?php echo e($afd->id_blok); ?></td>"+
				"</tr>"+
				"<tr>"+
				"<td>Deskripsi</td><td>:</td><td><?php echo e($afd->deskripsi); ?></td>"+
				"</tr>"+
				"<tr>"+
				"<td>Jumlah Pohon</td><td>:</td><td><?php echo e(number_format( $afd->jumlah_pohon, 0 , '.' , ',' )); ?></td>"+
				"</tr>"+
				"<tr>"+
				"<td>Luas Blok</td>"+
				"<td>:</td><td>"+IO.OUT_luas((JSON.parse(<?php echo json_encode($afd->koordinat)?>)),map,"")+"</td></tr>"+
				"<tr>"+
				"<td>Jumlah Panen</td>"+
				"<td>:</td><td><?php echo e(number_format( \App\Taksasi::where('id_blok',$afd->id_blok)->pluck('panen')->first(), 0 , '.' , ',' )); ?> Buah</td></tr>"+
				"</table>");
			infowindow.open(map);
		});
		<?php endforeach; ?>
		
		
		<?php foreach(\App\TPH::all() as $afd): ?>
		var wilayah = IO.OUT((JSON.parse(<?php echo json_encode($afd->koordinat)?>)),map,'<?php echo e($afd->warna); ?>');
		var shape = wilayah[0];
		var infowindow = new google.maps.InfoWindow();

		google.maps.event.addListener(shape, 'click', function(e) {
			infowindow.setPosition(e.latLng);
			infowindow.setContent(
				"<h5><strong>INFORMASI TPH</strong></h5>"+
				"<table class='table'>"+
				"<tr>"+
				"<td>Nama TPH</td><td>:</td><td><?php echo e($afd->deskripsi); ?></td>"+
				"</tr>"+
				"</table>");
			infowindow.open(map);
		});
		<?php endforeach; ?>
	}
var IO={
  //returns array with storable google.maps.Overlay-definitions
  IN:function(arr,//array with google.maps.Overlays
    encoded){//boolean indicating whether pathes should be stored encoded){
  	var shapes     = [],
  	goo=google.maps,
  	shape,tmp;

  	for(var i = 0; i < arr.length; i++)
  	{
  		shape=arr[i];
  		tmp={type:this.t_(shape.type),id:shape.id||null};

  		switch(tmp.type){
  			case 'CIRCLE':
  			tmp.radius=shape.getRadius();
  			tmp.geometry=this.p_(shape.getCenter());
  			break;
  			case 'MARKER':
  			tmp.geometry=this.p_(shape.getPosition());
  			break;
  			case 'RECTANGLE':
  			tmp.geometry=this.b_(shape.getBounds());
  			break;
  			case 'POLYLINE':
  			tmp.geometry=this.l_(shape.getPath(),encoded);
  			break;
  			case 'POLYGON':
  			tmp.geometry=this.m_(shape.getPaths(),encoded);

  			break;
  		}
  		shapes.push(tmp);
  	}

  	return shapes;
  },
	OUT_luas:function(arr,//array containg the stored shape-definitions
		map,//map where to draw the shapes
		color){
			var shapes = [],
			goo=google.maps,
			map=map||null,
			shape,tmp;

			for(var i = 0; i < arr.length; i++)
			{
				shape=arr[i];

				switch(shape.type){
					case 'CIRCLE':
					tmp=new goo.Circle({radius:Number(shape.radius),center:this.pp_.apply(this,shape.geometry)});
					break;
					case 'MARKER':
					tmp=new goo.Marker({position:this.pp_.apply(this,shape.geometry)});
					break;
					case 'RECTANGLE':
					tmp=new goo.Rectangle({bounds:this.bb_.apply(this,shape.geometry)});
					break;
					case 'POLYLINE':
					tmp=new goo.Polyline({path:this.ll_(shape.geometry)});
					break;
					case 'POLYGON':
					// tmp=new goo.Polygon({paths:this.mm_(shape.geometry),
					//   strokeColor: '#FF0000',
					//   strokeOpacity: 0.8,
					//   strokeWeight: 1.5,
					//   fillColor: color,
					//   fillOpacity: 0.4});
					console.log(this.mm_(shape.geometry));
					var coord1 = [];
					for(var i1=0 ; i1<shape.geometry[0].length ; i1++)
					{
						coord1.push(new google.maps.LatLng(shape.geometry[0][i1][0],shape.geometry[0][i1][1]));
					}
					tmp = google.maps.geometry.spherical.computeArea(coord1);

					break;
				}
			}
			return (tmp/(1000*1000)).toFixed(2) +" km persegi";
		},
  OUT:function(arr,//array containg the stored shape-definitions
    map,//map where to draw the shapes
    color){
  	var shapes = [],
  	goo=google.maps,
  	map=map||null,
  	shape,tmp;

  	for(var i = 0; i < arr.length; i++)
  	{
  		shape=arr[i];

  		switch(shape.type){
  			case 'CIRCLE':
  			tmp=new goo.Circle({radius:Number(shape.radius),center:this.pp_.apply(this,shape.geometry)});
  			break;
  			case 'MARKER':
  			tmp=new goo.Marker({position:this.pp_.apply(this,shape.geometry)});
  			break;
  			case 'RECTANGLE':
  			tmp=new goo.Rectangle({bounds:this.bb_.apply(this,shape.geometry)});
  			break;
  			case 'POLYLINE':
  			tmp=new goo.Polyline({path:this.ll_(shape.geometry)});
  			break;
  			case 'POLYGON':
  			tmp=new goo.Polygon(
  				{paths:this.mm_(shape.geometry),
  					strokeColor: '#FF0000',
  					strokeOpacity: 0.8,
  					strokeWeight: 1.5,
  					fillColor: color,
  					fillOpacity: 0.3});
  			break;
  		}
  		tmp.setValues({map:map,id:shape.id});
  		shapes.push(tmp);
  	}
  	return shapes;
  },
  l_:function(path,e){
        path=(path.getArray)?path.getArray():path;
        if(e){
          return google.maps.geometry.encoding.encodePath(path);
        }else{
          var r=[];
          for(var i=0;i<path.length;++i){
            r.push(this.p_(path[i]));
          }
          return r;
        }
      },
      ll_:function(path){
        if(typeof path==='string'){
          return google.maps.geometry.encoding.decodePath(path);
        }
        else{
          var r=[];
          for(var i=0;i<path.length;++i){
            r.push(this.pp_.apply(this,path[i]));
          }
          return r;
        }
      },

      m_:function(paths,e){
        var r=[];
        paths=(paths.getArray)?paths.getArray():paths;
        for(var i=0;i<paths.length;++i){
          r.push(this.l_(paths[i],e));
        }
        return r;
      },
      mm_:function(paths){
        var r=[];
        for(var i=0;i<paths.length;++i){
          r.push(this.ll_.call(this,paths[i]));
        }
        return r;
      },
      p_:function(latLng){
        return([latLng.lat(),latLng.lng()]);
      },
      pp_:function(lat,lng){
        return new google.maps.LatLng(lat,lng);
      },
      b_:function(bounds){
        return([this.p_(bounds.getSouthWest()),
          this.p_(bounds.getNorthEast())]);
        },
        bb_:function(sw,ne){
          return new google.maps.LatLngBounds(this.pp_.apply(this,sw),
          this.pp_.apply(this,ne));
        },
        t_:function(s){
          var t=['CIRCLE','MARKER','RECTANGLE','POLYLINE','POLYGON'];
          for(var i=0;i<t.length;++i){
            if(s===google.maps.drawing.OverlayType[t[i]]){
              return t[i];
            }
          }
        }
};

$("#btnsimpan").click(function(e){
	e.preventDefault();
	var conf = confirm("apakah anda yakin ingin menyimpan ?");

	if(conf==true)
	{

		var data = IO.IN(shapes,false);
		$("#coord").val(JSON.stringify(data));
		$("#formtambahpeta").submit();
	}else {

	}
});

$("#btnsimpanblok").click(function(e){
	e.preventDefault();
	var conf = confirm("apakah anda yakin ingin menyimpan ?");

	if(conf==true)
	{

		var data = IO.IN(shapes,false);
		$("#coordblok").val(JSON.stringify(data));
		$("#formtambahpetablok").submit();
	}
	else {

	}
});

$("#btnsimpantph").click(function(e){
  e.preventDefault();
  var conf = confirm("apakah anda yakin ingin menyimpan ?");

  if(conf==true)
  {

    var data = IO.IN(shapes,false);
    $("#coordtph").val(JSON.stringify(data));
    $("#formtambahpetatph").submit();
  }
  else {

  }
});

$("#submithapusblok").click(function(){
	var conf = confirm("apakah anda yakin ingin menghapus blok ini ?");
	if(conf ==  true)
	{
		$("#hapusblok").submit();
	}
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
    }
});

$(".afd-pilih-2").change(function(){
	$.ajax({
		url: '<?php echo e(route("showblok")); ?>',
		data: {id : $('.afd-pilih-2').val()},
		type: 'get',
		success : function(data){
			$("#displaybloklist").html(data);
		}
	})
})

$("#submithapus").click(function(e){
	e.preventDefault();
	var conf = confirm("apakah anda yakin ingin menyimpan ?");

	if(conf==true)
	{
		$.ajax({
			url: '<?php echo e(route("getstatusafdeling")); ?>',
			data: {id: $('.afd-pilih-1').val() },
			type: 'get',
			success: function(data)
			{
				if(data == "yes")
				{
					$("#hapusafdeling").submit();
				}
				else {
					alert("afdeling masih berisi blok");
				}
			}
		});


	}
	else {

	}
});

$(".pilih-blok").change(function(){
   $.ajax({
      type: 'get',
      url: '../refreshtph/'+$(this).val(),
      success: function(data)
      {
          $("#displaytphlist").html(data);
      }
   }); 
});

$(".pilih-afd").change(function(){
    $.ajax({
      type: 'get',
      url: '../refreshblok/'+$(this).val(),
      success: function(data)
      {
          
          $(".displaybloklist1").html(data);
          $.ajax({
                                  type: 'get',
                                  url: '../refreshtph/'+$(".pilih-blok").val(),
                                  success: function(data)
                                  {
                                      $("#displaytphlist").html(data);
                                  }
                               }); 
      }
   }); 
});

(function($){
     $.ajax({
      type: 'get',
      url: '../refreshblok/'+$(".pilih-afd").val(),
      success: function(data)
      {
          
          $(".displaybloklist1").html(data);
          $.ajax({
                                  type: 'get',
                                  url: '../refreshtph/'+$(".pilih-blok").val(),
                                  success: function(data)
                                  {
                                      $("#displaytphlist").html(data);
                                  }
                               }); 
      }
   }); 
})(jQuery)

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYs3t1HIkNrhLmr1cB1zod7BO9U5rGV4A&callback=initMap&libraries=drawing" async defer></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>