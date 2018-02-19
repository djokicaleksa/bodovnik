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
            @if(Auth::user()->isAdmin())
                <a class="btn btn-info" href="{{url('meetings/' . $meeting->id . '/edit')}}">Izmeni</a>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Ime</th>
                <th>Lokacija</th>
                <th>Datum</th>

                @if(Auth::user()->isAdmin())
                    <th></th>
                @endif
            </tr>
            </thead>
            <tbody>
                @foreach($meeting->users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td></td>
                    <td></td>

                    @if(Auth::user()->isAdmin())
                        <td>
                            {!! Form::model($meeting, ['method'=>'delete', 'action'=>['MeetingController@destroy', $meeting->id]]) !!}
                            {!! Form::submit("Izbriši", ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection