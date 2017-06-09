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


            {!! Form::open(['method'=>'post', 'action'=>'UsersController@store']) !!}
            {!! csrf_field() !!}
            <div class="form-group">
                <label>Ime i prezime</label>
                <input class="form-control" name="name" placeholder="">
            </div>

            <div class="form-group">
                <label>Email</label>
                {!! Form::text('email', null, ['class'=>'form-control', 'rows'=>5]) !!}
            </div>
            <div class="form-group">
                <label>Uloga</label>
                {!! Form::select('role_id', [''=>'Izaberite ulogu'] + $roles->all(), null, ['style'=>'width:100%;']) !!}
            </div>

            <div class="form-group">
                <label>Tim</label>
                {!! Form::select('team_id', [''=>'Izaberite tim'] + $teams->all(), null, ['style'=>'width:100%;']) !!}
            </div>
            <div class="form-group">
                <label>Rođendan</label>
                {!! Form::date('birthday',null, ['style'=>'width:100%;', 'class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Telefon</label>
                {!! Form::text('phone', null, ['style'=>'width:100%;', 'class'=>'form-control']) !!}
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