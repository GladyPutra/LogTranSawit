<?php $__env->startSection('custom_css'); ?>
<!-- <meta http-equiv="refresh" content="1"> -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Tampil Distribusi
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
				<div class="col-md-12 form-group">
					<div id="map" style="width:100%;height:500px"></div>
				</div>
			</div>
		</div>
		<input type="hidden" class="tempcoord">
		<form>

		</form>
		<!--End Advanced Tables -->
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_script'); ?>
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
    }
});



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

	function draws()
	{
		var crd;
		$.ajax({
			url: '<?php echo e(route("refreshcoord")); ?>',
			type: 'get',
			success : function(data){
				// $(".tempcoord").val(data.replace(/\s/g, ''));
				//console.log(data[1].length);
				console.log(data);
				var i;
				for(i=0;i<(data[0].length);i++)
				{
					  //console.log(data[0].length);
						var markerAsal = new google.maps.Marker({
					    position: data[0][i][0],
					    map: map,
					    title: 'Asal'
					  });

						var markerTujuan = new google.maps.Marker({
					    position: data[0][i][data[0][i].length-1],
					    map: map,
					    title: 'Tujuan',
							icon: '<?php echo e(asset("truck.png")); ?>'
					  });

					var contentString = '<label>Nama Sopir : '+ data[1][i][1]+'</label><br/>'+
					'<label>Berat : '+ data[1][i][0]+' Kg</label>';

	        var infowindow = new google.maps.InfoWindow({
	          content: contentString
	        });
						markerAsal.addListener('click',function(){
							infowindow.open(map, markerAsal);
						});
						crd = new google.maps.Polyline({
						 path: data[0][i],
						 geodesic: true,
						 strokeColor: '#0000FF',
						 strokeOpacity: 1.0,
						 strokeWeight: 10
					 });
					 crd.setMap(map);
				}
			}
		})
	}
	setInterval(draws, 1000);

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
    OUT_center:function(arr,//array containg the stored shape-definitions
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

            for (var i = 0; i < coord1.length; i++) {
              bounds.extend(coord1[i]);
            }

  					tmp = bounds.getCenter();

  					break;
  				}
  			}
  			return tmp;
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



</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYs3t1HIkNrhLmr1cB1zod7BO9U5rGV4A&callback=initMap&libraries=drawing" async defer></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>