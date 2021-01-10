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
                                    <h2>Data Solusi</h2>
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
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Solusi</button>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table class="table table-striped table-bordered table-hover" id="datatable">

                                                            <thead>
                                                                <tr>
                                                                    <th>SOLUSI</th>
                                                                    <th>KETERANGAN</th>
                                                                    <th>AKSI</th>
                                                                </tr>
                                                            </thead>

                                                            @foreach($solusi as $sls)
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{$sls->solusi}}</td>
                                                                    <td>{{$sls->keterangan}}</td>
                                                                    <?php
                                                                        $edit = url('/solusi/'.$sls->id_solusi.'/edit/');
                                                                        $delete = url('/solusi/'.$sls->id_solusi.'/delete/');
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solusi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/solusi/create')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputSolusi">Solusi</label>
                        <input name='solusi' type="text" class="form-control" aria-describedby="Solusi" placeholder="Solusi" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKeterangan">Keterangan</label>
                        <textarea name='keterangan' type="text" class="form-control" aria-describedby="Keterangan" placeholder="Keterangan" rows="5" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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