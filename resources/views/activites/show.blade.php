@extends('layouts.custom')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{$route}} <small>Statistics Overview</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div>

    <div class="row center-block">
        <div class="col-md-6 col-sm-12 col-lg-6 ">

            <div class="form-group">
                <label>Naziv aktivnosti</label>
                {{$activity->name}}
            </div>

            <div class="form-group">
                <label>Broj poena</label>
                {{$activity->points}}
            </div>
            <div class="form-group">
                <label>Oblast</label>
                {{$activity->team->name}}
            </div>

            <div class="form-group">

            </div>
        </div>
    </div>
@endsection
