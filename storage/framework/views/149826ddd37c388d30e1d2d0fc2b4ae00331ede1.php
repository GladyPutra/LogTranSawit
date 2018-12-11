<?php $__env->startSection('custom_css'); ?>
<style>
/* table td {
    border-top: none !important;
} */
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
PETA
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


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
				<div class="col-md-3 col-md-offset-4" style="padding: 10px 10px 10px 10px;text-align:center; margin-bottom:10px;color:black;background:rgba(194, 214, 214,0.3);">
				    <?php if(!\App\Taksasi::where('id_taksasi',\App\Taksasi::max('id_taksasi'))->pluck('tgl_taksasi')->first()): ?>
				        <strong>Tanggal Taksasi : <?php echo e(date('d/m/Y')); ?></strong>
				    </div>
				    <?php else: ?>
				        <strong>Tanggal Taksasi : <?php echo e(date('d/m/Y',strtotime(\App\Taksasi::where('id_taksasi',\App\Taksasi::max('id_taksasi'))->pluck('tgl_taksasi')->first()))); ?></strong>
				    </div>
				    <?php endif; ?>
				    
			</div>
			<div class="row">
				<div class="col-md-2 col-md-offset-1" style="color:black;background:rgba(194, 214, 214,0.3);">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<table style="margin-top:12px" class="table table-bordered">
							<thead>
								<tr>
									<th style="text-align:center" colspan="2">Taksasi Tahunan</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align:center"><h3><strong><?php echo e(number_format( $tahunanbuah, 0 , '.' , ',' )); ?></strong></h3> buah</td>
									<td style="text-align:center"><h3><strong><?php echo e(number_format( $tahunanberat, 0 , '.' , ',' )); ?></strong></h3> Kg</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				</div>
				<div class="col-md-2" style="color:black;background:rgba(194, 214, 214,0.3);margin-left:60px">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<table style="margin-top:12px" class="table table-bordered">
							<thead>
								<tr>
									<th style="text-align:center" colspan="2">Taksasi Bulanan</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align:center"><h3><strong><?php echo e(number_format( $bulananbuah, 0 , '.' , ',' )); ?></strong></h3> buah</td>
									<td style="text-align:center"><h3><strong><?php echo e(number_format( $bulananberat, 0 , '.' , ',' )); ?></strong></h3> Kg</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				</div>
				<div class="col-md-2" style="color:black;background:rgba(194, 214, 214,0.3);margin-left:60px">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<table style="margin-top:12px" class="table table-bordered">
							<thead>
								<tr>
									<th style="text-align:center" colspan="2">Taksasi Mingguan</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align:center"><h3><strong><?php echo e(number_format( $mingguanbuah, 0 , '.' , ',' )); ?></strong></h3> buah</td>
									<td style="text-align:center"><h3><strong><?php echo e(number_format( $mingguanberat, 0 , '.' , ',' )); ?></strong></h3> Kg</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				</div>
				<div class="col-md-2" style="color:black;background:rgba(194, 214, 214,0.3);margin-left:60px">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<table style="margin-top:12px" class="table table-bordered">
							<thead>
								<tr>
									<th style="text-align:center" colspan="2">Taksasi Harian</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align:center"><h3><strong><?php echo e(number_format( $harianbuah, 0 , '.' , ',' )); ?></strong></h3> buah</td>
									<td style="text-align:center"><h3><strong><?php echo e(number_format( $harianberat, 0 , '.' , ',' )); ?></strong></h3> Kg</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-md-12 form-group">
					<div id="map" style="width:100%;height:500px"></div>
				</div>
			</div>

			<hr style="width:100%;color:black;"/>

		</div>
		<form>

		</form>
		<!--End Advanced Tables -->
	</div>
</div>

<div id="modaltaksasi" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Taksasi: </h4>
				<h5 class="detailafdeling"></h5>
      </div>
			<form method="post" action="<?php echo e(route('tambahtaksasi')); ?>">
				<?php echo e(csrf_field()); ?>

				<input type="hidden" class="form-control idbloktemp" name="idblok"/>
	      <div class="modal-body">
					<div class="col-md-12 form-group">
						<label>Tanggal</label>
						<input type="text" class="form-control tgltaksasi" disabled/>
					</div>
					<div class="col-md-12 form-group">
						<label>Harian</label>
						<input type="number" class="form-control" name="harian"/>
					</div>
					<div class="col-md-12 form-group">
						<label>Mingguan</label>
						<input type="number" class="form-control" name="mingguan"/>
					</div>
					<div class="col-md-12 form-group">
						<label>Bulanan</label>
						<input type="number" class="form-control" name="bulanan"/>
					</div>
					<div class="col-md-12 form-group">
						<label>Tahunan</label>
						<input type="number" class="form-control" name="tahunan"/>
					</div>
					<div class="col-md-12 form-group">
						<label>Berat Rata-Rata(Kg)</label>
						<input type="number" class="form-control" name="rata"/>
					</div>
					<div class="col-md-4 form-group">
						<button class="btn btn-success btn-md">Tambah</button>
					</div>
	      </div>
			</form>

      <div class="modal-footer">
				<div class="row">

				</div>
      </div>
    </div>

  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_script'); ?>
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

		<?php foreach(\App\Afdeling::all() as $afd): ?>
			<?php if($afd->id_user == \Auth::user()->id_user):?>
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
			<?php endif; ?>
		<?php endforeach; ?>

		<?php foreach(\App\Blok::all() as $blok): ?>
			<?php if(\App\Afdeling::where('id_afdeling',$blok->id_afdeling)->pluck('id_user')->first() == \Auth::user()->id_user):?>
				var wilayah = IO.OUT((JSON.parse(<?php echo json_encode($blok->koordinat)?>)),map,'<?php echo e($afd->warna); ?>');
				var shape = wilayah[0];
				var infowindow = new google.maps.InfoWindow();

				google.maps.event.addListener(shape, 'click', function(e) {
					infowindow.setPosition(e.latLng);
					infowindow.setContent(
						"<h5><strong>INFORMASI BLOK</strong></h5>"+
						"<table class='table'>"+
						"<tr>"+
						"<td>Nama Krani</td><td>:</td><td><?php echo e(\App\User::where('id_user',\App\Krani::where('id_blok',$blok->id_blok)->pluck('id_user')->first())->pluck('nama')->first()); ?></td>"+
						"</tr>"+
						"<tr>"+
						"<td>ID Afdeling</td><td>:</td><td><?php echo e($blok->id_afdeling); ?></td>"+
						"</tr>"+
						"<tr>"+
						"<td>ID Blok</td><td>:</td><td><?php echo e($blok->id_blok); ?></td>"+
						"</tr>"+
						"<tr>"+
						"<td>Deskripsi</td><td>:</td><td><?php echo e($blok->deskripsi); ?></td>"+
						"</tr>"+
						"<tr>"+
						"<td>Jumlah Pohon</td><td>:</td><td><?php echo e(number_format( $blok->jumlah_pohon, 0 , '.' , ',' )); ?></td>"+
						"</tr>"+
						"<tr>"+
						"<td>Luas Blok</td>"+
						"<td>:</td><td>"+IO.OUT_luas((JSON.parse(<?php echo json_encode($blok->koordinat)?>)),map,"")+"</td></tr>"+
						"<tr>"+
						"<td>Jumlah Panen</td>"+
						"<td>:</td><td><?php echo e(number_format( \App\Taksasi::where('id_blok',$blok->id_blok)->pluck('panen')->first(), 0 , '.' , ',' )); ?> Buah</td></tr>"+
						"</table>"+
						"<td></td>"+
						"<td>:</td><td><button class='btn btn-sm btn-primary inputtaksasi' data-idafdeling='<?php echo e($blok->id_afdeling); ?>' data-idblok='<?php echo e($blok->id_blok); ?>' data-toggle='modal' data-target='#modaltaksasi'>Tambah Taksasi</button></td></tr>"+
						"</table>");
					infowindow.open(map);
				});
			<?php endif; ?>
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

	var conf = confirm("apakah anda yakin ingin menyimpan ?");

	if(conf==true)
	{
		e.preventDefault();
		var data = IO.IN(shapes,false);
		$("#coord").val(JSON.stringify(data));
		$("#formtambahpeta").submit();
	}


});

$("#submithapus").click(function(e){
var conf = confirm("apakah anda yakin ingin menyimpan ?");

if(conf==true)
{
	$("#hapusafdeling").submit();
}
});
var idafdeling = 0;
var idblok = 0;
$('#modaltaksasi').on('show.bs.modal', function () {
  idafdeling = $(".inputtaksasi").data('idafdeling');
	idblok = $(".inputtaksasi").data('idblok');
	var n =  new Date();
	var y = n.getFullYear();
	var m = n.getMonth() + 1;
	var d = n.getDate();
	$(".tgltaksasi").val(m + "/" + d + "/" + y);
	$(".idbloktemp").val(idblok);
	$(".detailafdeling").text("ID Afdeling : "+idafdeling+" | ID Blok : "+idblok);
})
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYs3t1HIkNrhLmr1cB1zod7BO9U5rGV4A&callback=initMap&libraries=drawing" async defer></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>