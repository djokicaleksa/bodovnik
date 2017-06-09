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
            @if(Auth::user()->isAdmin())
                <a href="{{url('/users/create')}}" class="btn btn-info">Dodaj člana</a><br>
            @endif
                Tim lider: <b>{{$team->leader->name}}</b><br>
            {{$team->description}}
        </div>
    </div>

    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Ime i prezime</th>
            <th>Broj bodova</th>
            <th>E-mail</th>
            @if(Auth::user()->isAdmin())
                <th></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($team->users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->points()}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="{{url('/users/'.$user->id)}}" class="btn btn-warning">Prikaži</a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{url('/users/'.$user->id.'/edit')}}" class="btn btn-info">Izmeni</a>
                        {!! Form::open(['action'=>['UsersController@destroy', $user->id], 'method'=>'delete', 'style'=>'display:inline'])  !!}
                        <input type="submit" class="btn btn-danger" value="Izbriši">
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection