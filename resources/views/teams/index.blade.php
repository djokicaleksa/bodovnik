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
                <a href="{{url('/teams/create')}}" class="btn btn-info">Novi tim</a>
            @endif
        </div>
    </div>

    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Naziv tima</th>
            <th>Tim lider</th>
            <th>Broj clanova</th>
            @if(Auth::user()->isAdmin())
            <th></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($teams as $team)
        <tr>
            <td>{{$team->name}}</td>
            <td>{{$team->leader->name}}</td>
            <td>{{$team->users->count()}}</td>
            <td>
                <a href="{{url('/teams/'.$team->id)}}" class="btn btn-warning">Prikaži</a>
                @if(Auth::user()->isAdmin())
                    <a href="{{url('/teams/'.$team->id.'/edit')}}" class="btn btn-info">Izmeni</a>
                    {!! Form::open(['action'=>['TeamController@destroy', $team->id], 'method'=>'delete', 'style'=>'display:inline'])  !!}
                    <input type="submit" class="btn btn-danger" value="Izbriši">
                    {!! Form::close() !!}
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection