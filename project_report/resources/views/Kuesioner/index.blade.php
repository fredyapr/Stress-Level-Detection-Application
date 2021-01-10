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
                                    <h2>Data Kuesioner</h2>
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
                                                        <button type="button" class="btn fa fa-info-circle btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModal"></button>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table class="table table-striped table-bordered table-hover" id="datatable">

                                                            <thead>
                                                                <tr>
                                                                    <th>NAMA KUESIONER</th>
                                                                    <!-- <th>AKSI</th> -->
                                                                </tr>
                                                            </thead>

                                                            @foreach($data_kuesioner as $kuesioner)
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{$kuesioner->nama_kuesioner}}</td>
                                                                    <?php 
                                                                         $edit = url('/kuesioner/'.$kuesioner->id_kuesioner.'/edit/');
                                                                         $delete = url('/kuesioner/'.$kuesioner->id_kuesioner.'/delete/');
                                                                    ?>
                                                                    <!-- <td><a href="{{$edit}}" class="btn fa fa-edit btn-success btn-sm"></a></td> -->
                                                                    <!-- &nbsp;&nbsp;<a href="{{$delete}}" class="btn fa fa-trash-o btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')"></a> -->
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

<!-- <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kuesioner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kuesioner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <br>Pertanyaan dalam skala ini menanyakan tentang perasaan dan pikiran seseorang selama sebulan terakhir.
            Untuk setiap pertanyaan memiliki alternatif jawaban sebagai berikut:</br>
            <br>0 = Tidak Pernah</br>
            <br>1 = Hampir Tidak Pernah</br>
            <br>2 = Kadang-Kadang</br>
            <br>3 = Sering</br>
            <br>4 = Sangat Sering</br>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    })
</script>
@endsection