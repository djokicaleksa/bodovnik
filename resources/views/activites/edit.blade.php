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


            {!! Form::model($activity, ['method'=>'put', 'action'=>['ActivityController@update', $activity->id]]) !!}
            {!! csrf_field() !!}
            <div class="form-group">
                <label>Naziv aktivnosti</label>
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Broj poena</label>
                {!! Form::number('points', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Oblast</label>
                {!! Form::select('team_id', [''=>'Izaberite tim lidera'] + $teams->all(), null, ['style'=>'width:100%;']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Sačuvaj', ['class'=>'btn btn-info']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript" src="{{url('js/select2/dist/js/select2.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select').select2();
        })
    </script>
@endsection