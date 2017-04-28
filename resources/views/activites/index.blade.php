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
                <a href="{{url('/activities/create')}}" class="btn btn-info">Nova aktivnost</a>
            @endif
        </div>
    </div>

    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Naziv aktivnosti</th>
            <th>Broj poena</th>
            <th>Oblast</th>
            @if(Auth::user()->isAdmin())
                <th></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($activities as $activity)
            <tr>
                <td>{{$activity->name}}</td>
                <td>{{$activity->points}}</td>
                <td>{{$activity->team->name}}</td>
                <td>
                    <a href="{{url('/activities/'.$activity->id)}}" class="btn btn-warning">Prikaži</a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{url('/activities/'.$activity->id.'/edit')}}" class="btn btn-info">Izmeni</a>
                        {!! Form::open(['action'=>['ActivityController@destroy', $activity->id], 'method'=>'delete', 'style'=>'display:inline'])  !!}
                        <input type="submit" class="btn btn-danger" value="Izbriši">
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection