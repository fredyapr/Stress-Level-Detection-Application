@extends('template.backend.main')
@section('title')
    Dashboard STRESSOR
@endsection
@section('ribbon')
    <ol class="breadcrumb">
        <li>Dashboard</li>
    </ol>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-3">
            <h1 class="page-title txt-color-blueDark text-center well">
            <i class="fa fa-lg fa-fw fa-tasks"></i>
            <div>{{ $count_kuesioner }}</div>
            Kuesioner
            <div class="panel">
                <div id="chart"></div>
            </div>
            </h1>
        </div>

        <div class="col-md-3">
            <h1 class="page-title txt-color-blueDark text-center well">
            <i class="fa fa-lg fa-fw fa-book"></i>
            <div>{{ $count_solusi }}</div>
            Solusi
            <div class="panel">
                <div id="chart"></div>
            </div>
            </h1>
        </div>

        <div class="col-md-3">
            <h1 class="page-title txt-color-blueDark text-center well">
            <i class="fa fa-lg fa-fw fa-fax"></i>
            <div>{{ $count_klinik }}</div>
            Klinik
            <div class="panel">
                <div id="chart"></div>
            </div>
            </h1>
        </div>
    </div>
@endsection
@section('js')

@endsection