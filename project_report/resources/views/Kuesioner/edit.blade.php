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
                                        <div class="col-sm-12">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                    <?php
                                                        $update = url('/kuesioner/'.$kuesioner->id_kuesioner.'/update/');
                                                    ?>
                                                        <form action="{{$update}}" method="POST">
                                                            {{csrf_field()}}
                                                            <div class="form-group">
                                                                <label for="exampleInputKuesioner">Kuesioner</label>
                                                                <input name='nama_kuesioner' type="text" class="form-control" aria-describedby="Kuesioner" placeholder="Kuesioner" value="{{$kuesioner->nama_kuesioner}}" required="">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{url('/kuesioner/')}}"></ahref><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-warning">Update</button>
                                                            </div>
                                                        </form>
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
@endsection