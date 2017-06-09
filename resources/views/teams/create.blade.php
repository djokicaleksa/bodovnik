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


    {!! Form::open(['method'=>'post', 'action'=>'TeamController@store']) !!}
    {!! csrf_field() !!}
    <div class="form-group">
        <label>Naziv tima</label>
        <input class="form-control" name="name" placeholder="">
    </div>

    <div class="form-group">
        <label>Opis tima</label>
        {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>5]) !!}
    </div>
    <div class="form-group">
        <label>Tim lider</label>
        {!! Form::select('team_leader', [''=>'Izaberite tim lidera'] + $users->all(), null, ['style'=>'width:100%;']) !!}
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