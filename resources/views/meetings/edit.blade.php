@extends('layouts.custom')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{$route}} <small></small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>

        </div>
    </div>

    <div class="table-responsive">
        {!! Form::model($meeting, ['method'=>'put', 'action'=>['MeetingController@update', $meeting->id]]) !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}<br>
            {!! Form::text('location', null, ['class'=>'form-control']) !!}<br>
            @foreach($meeting->team->users as $user)

                @if($meeting->users->contains($user->id))
                    <input type="checkbox" name="users[]" value="{{$user->id}}" checked>{{$user->name}}<br>
                @else
                    <input type="checkbox" name="users[]" value="{{$user->id}}">{{$user->name}}<br>
                @endif

            @endforeach
            <br>
            {!! Form::submit('Sačuvaj', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
@endsection