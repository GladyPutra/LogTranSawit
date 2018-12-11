<?php $__env->startSection('custom_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
PETA
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="row">
	<div class="col-lg-12">
		<!-- Advanced Tables -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<!--  -->
			</div>
			<div class="panel-body">
			<div class="row">
				<div class="col-md-2" style="background:rgba(255,0,0,0.3);margin-left:60px">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<p class="card-text">Some quick example text on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
				</div>
				<div class="col-md-3" style="background:rgba(255,0,0,0.3);margin-left:20px">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
				</div>
				<div class="col-md-3" style="background:rgba(255,0,0,0.3);margin-left:20px">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
				</div>
				<div class="col-md-2" style="background:rgba(255,0,0,0.3);margin-left:20px;padding-right:30px">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<p class="card-text">Some quick example text on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
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
			<div class="row">
				<form id="formtambahpeta" action="<?php echo e(route('afdeling.simpan')); ?>" method="post">
				<?php echo e(csrf_field()); ?>

				<div class="col-md-12 form-group">
					<div class="col-md-1">
					<label>Warna</label>
					<input type="color" name="favcolor" value="#ff0000" class="form-control">
					</div>
				</div>
				<div class="col-md-12 form-group">
				<div class="col-md-3">
					<label>Jumlah Pohon</label>
					<input type="number" class="form-control" name="jumlahpohon"/>
				</div>
				<div class="col-md-12 form-group">
					<label>Deskripsi</label>
					<input type="text" class="form-control" name="deskripsi"/>
				</div>
				<input type="text" style="display:none" name="coord" id="coord"/>
				<div class="col-md-12 form-group">
					<a class="btn btn-sm btn-danger" id="clear_shapes">Clear Shape</a>
					<button class="btn btn-sm btn-success" id="btnsimpan">Simpan</button>
					<br/>
					<hr style="color:black;width100%"/>
				</div>
				</form>
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
	var map;
	var shapes = [];
	var selected_shape=null;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -2.566801, lng: 119.172897},
			zoom: 10
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
			drawingMode: google.maps.drawing.OverlayType.POLYGON,
			drawingControl: true,
			drawingControlOptions: {
				position: google.maps.ControlPosition.TOP_CENTER,
				drawingModes: ['polygon']
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

		<?php foreach(\App\Afdeling::all() as $afd): ?>
			IO.OUT((JSON.parse(<?php echo json_encode($afd->koordinat)?>)),map,'<?php echo e($afd->warna); ?>');
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
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYs3t1HIkNrhLmr1cB1zod7BO9U5rGV4A&callback=initMap&libraries=drawing" async defer></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>