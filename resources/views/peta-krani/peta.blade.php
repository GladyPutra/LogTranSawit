@extends('layouts.master')
@section('custom_css')
<style>
/* table td {
    border-top: none !important;
} */
</style>
@endsection

@section('title')
PETA
@endsection

@section('content')


<div class="row">
	<div class="col-lg-12">
	@if(count($errors)>0)
    <ul>
        @foreach($errors->all() as $error)

            <li class="alert alert-danger">{{$error}}</li>

        @endforeach
    </ul>
	@endif
		<!-- Advanced Tables -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<!--  -->
			</div>
			<div class="panel-body">
		<!-- card -->
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
        <h4 class="modal-title">Tambah Panen: </h4>
				<h5 class="detailafdeling"></h5>
      </div>
			<form method="post" action="{{ route('tambahpanen') }}">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<input type="hidden" class="form-control idbloktemp" name="idblok"/>
	      <div class="modal-body">
					<div class="col-md-12 form-group">
						<label>Panen</label>
						<input type="number" class="form-control" name="panen"/>
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

@endsection

@section('custom_script')
<script>
	var map;
	var shapes = [];
	var selected_shape=null;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -1.266336, lng: 119.447592 },
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

		

		<?php $counts = 0?>

		<?php foreach(\App\Krani::where('id_user',\Auth::user()->id_user)->get() as $blok): ?>
			var wilayah = IO.OUT((JSON.parse(<?php echo json_encode(\App\Blok::where('id_blok',$blok->id_blok)->pluck('koordinat')->first())?>)),map,'#ff0000');
			var shape = wilayah[0];
			var infowindow = new google.maps.InfoWindow();

			google.maps.event.addListener(shape, 'click', function(e) {
				infowindow.setPosition(e.latLng);
				<?php if(!\App\Taksasi::where('id_blok',$blok->id_blok)->first()): ?>
				infowindow.setContent(
					"<h5><strong>INFORMASI BLOK</strong></h5>"+
					"<table class='table'>"+
					"<tr>"+
					"<td>Nama Krani</td><td>:</td><td>{{ \App\User::where('id_user',$blok->id_user)->pluck('nama')->first() }}</td>"+
					"</tr>"+
					"<tr>"+
					"<td>ID Afdeling</td><td>:</td><td>{{ \App\Blok::where('id_blok',$blok->id_blok)->pluck('id_afdeling')->first() }}</td>"+
					"</tr>"+
					"<tr>"+
					"<td>ID Blok</td><td>:</td><td>{{ $blok->id_blok }}</td>"+
					"</tr>"+
					"<tr>"+
					"<td>Deskripsi</td><td>:</td><td>{{ \App\Blok::where('id_blok',$blok->id_blok)->pluck('deskripsi')->first() }}</td>"+
					"</tr>"+
					"<tr>"+
					"<td>Jumlah Pohon</td><td>:</td><td>{{ number_format( \App\Blok::where('id_blok',$blok->id_blok)->pluck('jumlah_pohon')->first(), 0 , '.' , ',' ) }}</td>"+
					"</tr>"+
					"<tr>"+
					"<td>Luas Blok</td>"+
					"<td>:</td><td>"+IO.OUT_luas((JSON.parse(<?php echo json_encode(\App\Blok::where('id_blok',$blok->id_blok)->pluck('koordinat')->first())?>)),map,"")+"</td></tr>"+
					"<td>Jumlah Panen</td>"+
					"<td>:</td><td>{{ number_format( \App\Taksasi::where('id_blok',\App\Blok::where('id_blok',$blok->id_blok)->pluck('id_blok')->first())->pluck('panen')->first(), 0 , '.' , ',' ) }} Buah</td></tr>"+
					"</table>"+
					"<td></td>"+
					"<td>:</td><td><button class='btn btn-sm btn-primary inputtaksasi' onclick='showalerttaksasi()'>Input Panen</button></td></tr>"+
					"</table>");
				<?php else: ?>
				infowindow.setContent(
					"<h5><strong>INFORMASI BLOK</strong></h5>"+
					"<table class='table'>"+
					"<tr>"+
					"<td>Nama Krani</td><td>:</td><td>{{ \App\User::where('id_user',$blok->id_user)->pluck('nama')->first() }}</td>"+
					"</tr>"+
					"<tr>"+
					"<td>ID Afdeling</td><td>:</td><td>{{ \App\Blok::where('id_blok',$blok->id_blok)->pluck('id_afdeling')->first() }}</td>"+
					"</tr>"+
					"<tr>"+
					"<td>ID Blok</td><td>:</td><td>{{ $blok->id_blok }}</td>"+
					"</tr>"+
					"<tr>"+
					"<td>Deskripsi</td><td>:</td><td>{{ \App\Blok::where('id_blok',$blok->id_blok)->pluck('deskripsi')->first() }}</td>"+
					"</tr>"+
					"<tr>"+
					"<td>Jumlah Pohon</td><td>:</td><td>{{ number_format( \App\Blok::where('id_blok',$blok->id_blok)->pluck('jumlah_pohon')->first(), 0 , '.' , ',' ) }}</td>"+
					"</tr>"+
					"<tr>"+
					"<td>Luas Blok</td>"+
					"<td>:</td><td>"+IO.OUT_luas((JSON.parse(<?php echo json_encode(\App\Blok::where('id_blok',$blok->id_blok)->pluck('koordinat')->first())?>)),map,"")+"</td></tr>"+
					"<td>Jumlah Panen</td>"+
					"<td>:</td><td>{{ number_format( \App\Taksasi::where('id_blok',\App\Blok::where('id_blok',$blok->id_blok)->pluck('id_blok')->first())->pluck('panen')->first(), 0 , '.' , ',' ) }} Buah</td></tr>"+
					"</table>"+
					"<td></td>"+
					"<td>:</td><td><button class='btn btn-sm btn-primary inputtaksasi' data-idafdeling='{{ $blok->id_afdeling }}' data-idblok='{{ $blok->id_blok }}' data-toggle='modal' data-target='#modaltaksasi'>Tambah Panen</button></td></tr>"+
					"</table>");
				<?php endif;?>

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

	var conf = confirm("apakah anda yakin ingin menyimpan ?");

	if(conf==true)
	{
		e.preventDefault();
		var data = IO.IN(shapes,false);
		$("#coord").val(JSON.stringify(data));
		$("#formtambahpeta").submit();
	}


});
function showalerttaksasi()
{
	alert("Taksasi Belum Dilakukan");
}
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
	$(".idbloktemp").val(idblok);
	$(".detailafdeling").text(" ID Blok : "+idblok);
})
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYs3t1HIkNrhLmr1cB1zod7BO9U5rGV4A&callback=initMap&libraries=drawing" async defer></script>

@endsection
