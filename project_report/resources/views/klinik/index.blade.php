@extends('template.backend.main')
@section('title')
Dashboard STRESSOR
@endsection
@section('ribbon')
<ol class="breadcrumb">
    <!-- <li>Dashboard</li> -->
    <li class="pull-right"><?php echo date('j F, Y'); ?></li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        @if($errors->any())
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-warning fade in">
                                    <button class="close" data-dismiss="alert">
                                        ×
                                    </button>
                                    <i class="fa-fw fa fa-warning"></i>
                                    <strong>Peringatan</strong> {{$errors->first()}}
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(session()->has('message'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success fade in">
                                    <button class="close" data-dismiss="alert">
                                        ×
                                    </button>
                                    <i class="fa-fw fa fa-check"></i>
                                    <strong>Sukses</strong> {{session()->get('message')}}
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-lg-12">
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                                <header role="heading">
                                    <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                    <h2>Data Klinik</h2>
                                    <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                                </header>
                                <div role="content">
                                    <div class="jarviswidget-editbox">
                                    </div>
                                    <div class="widget-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="panel">
                                                    <div class="panel-heading">
                                                        <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                                            Tambah Klinik
                                                        </button> -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table class="table table-striped table-bordered table-hover" id="datatable">

                                                            <thead>
                                                                <tr>
                                                                    <th>NAMA KLINIK</th>
                                                                    <th>NO. TELP</th>
                                                                    <th>ALAMAT</th>
                                                                    <th>LATITUDE</th>
                                                                    <th>LONGITUDE</th>
                                                                    <th>AKSI</th>
                                                                </tr>
                                                            </thead>

                                                            @foreach($data_klinik as $klinik)
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{$klinik->nama_klinik}}</td>
                                                                    <td>{{$klinik->no_telp}}</td>
                                                                    <td>{{$klinik->alamat_klinik}}</td>
                                                                    <td>{{$klinik->lat_klinik}}</td>
                                                                    <td>{{$klinik->long_klinik}}</td>
                                                                    <?php 
                                                                         $edit = url('/klinik/'.$klinik->id_klinik.'/edit/');
                                                                         $delete = url('/klinik/'.$klinik->id_klinik.'/delete/');
                                                                    ?>
                                                                    <td><a href="{{$edit}}" class="btn fa fa-edit btn-success btn-sm"></a> 
                                                                    &nbsp;&nbsp;<a href="{{$delete}}" class="btn fa fa-trash-o btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')"></a></td>
                                                                </tr>
                                                            </tbody>

                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr class="simple">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Klinik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
            <form action="{{url('/klinik/create')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputKlinik">Klinik</label>
                        <input name='nama_klinik' type="text" class="form-control" aria-describedby="Klinik" placeholder="Klinik" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKlinik">No. Telp</label>
                        <input name='no_telp' type="text" class="form-control" aria-describedby="No. Telp" placeholder="No. Telp" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKlinik">Alamat</label>
                        <input name='alamat_klinik' type="text" class="form-control" aria-describedby="Alamat" placeholder="Alamat" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKlinik">Latitude</label>
                        <input name='lat_klinik' id='lat_klinik' type="text" class="form-control" aria-describedby="Latitude" placeholder="Latitude" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKlinik">Longitude</label>
                        <input name='long_klinik' id='long_klinik' type="text" class="form-control" aria-describedby="Longitude" placeholder="Longitude" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="form-group">
                    <div id="maps"></div>
                    </div>
                </form>
            </div>      
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Klinik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
            <form action="{{url('/klinik/create')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputKlinik">Klinik</label>
                        <input name='nama_klinik' type="text" class="form-control" aria-describedby="Klinik" placeholder="Klinik" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKlinik">No. Telp</label>
                        <input name='no_telp' type="text" class="form-control" aria-describedby="No. Telp" placeholder="No. Telp" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKlinik">Alamat</label>
                        <input name='alamat_klinik' type="text" class="form-control" aria-describedby="Alamat" placeholder="Alamat" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKlinik">Latitude</label>
                        <input name='lat_klinik' id='lat_klinik' type="text" class="form-control" aria-describedby="Latitude" placeholder="Latitude" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKlinik">Longitude</label>
                        <input name='long_klinik' id='long_klinik' type="text" class="form-control" aria-describedby="Longitude" placeholder="Longitude" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                    <div class="form-group">
                    <div id="maps"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    })
    
    function initMap() {
        var myLatlng = {lat: -6.394390, lng: 106.822686};

        var map = new google.maps.Map(
            document.getElementById('maps'), {zoom: 11, center: myLatlng});

        // Create the initial InfoWindow.
        var infoWindow = new google.maps.InfoWindow(
            {content: 'Click the map to get Lat/Lng!', position: myLatlng});
        infoWindow.open(map);

        // Configure the click listener.
        map.addListener('click', function(mapsMouseEvent) {
          // Close the current InfoWindow.
          infoWindow.close();
          // Create a new InfoWindow.
          infoWindow = new google.maps.InfoWindow({position: mapsMouseEvent.latLng});
          infoWindow.setContent(mapsMouseEvent.latLng.toString());
          var lat_lng = mapsMouseEvent.latLng.toString();
          console.log(lat_lng);
          var fields = lat_lng.split(',');
          var lat = fields[0];
          var long = fields[1];
          $('#lat_klinik').val(lat.substr(1));
          $('#long_klinik').val(long.slice(1, -1));
          infoWindow.open(map);
        });
      }
</script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA53F7H05NQozzknNf1u37dwIQ8IiT3j1Q&callback=initMap">
</script>
@endsection