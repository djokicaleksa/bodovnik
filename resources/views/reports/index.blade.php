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
                <button class="btn btn-info" data-toggle="modal" data-target="#myModal">Dodaj izveštaj</button>
            @endif
        </div>
    </div>


    @foreach($allteams as $team)
        <div class="col-lg-6">
            <h2>{{$team->name}}</h2>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Naziv</th>
                        <th>Postavio</th>
                        <th>Datum</th>
                        <th>Download</th>
                        @if(Auth::user()->isAdmin())
                            <th></th>
                        @endif    
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($team->reports as $report)
                        <tr>
                            <td>{{$report->display_name}}</td>
                            <td>{{$report->user->name}}</td>
                            <td>{{$report->created_at}}</td>
                            <td><a href="{{url($report->url)}}" >link</a></td>
                            @if(Auth::user()->isAdmin())
                                <td>
                                    {!! Form::model($report, ['method'=>'delete', 'action'=>['ReportsController@destroy', $report->id]]) !!}
                                        {!! Form::submit("Izbriši", ['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}    
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Dodaj izveštaj</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method'=>'post', 'action'=>'ReportsController@store', 'files'=>true]) !!}
                    {!! Form::select('team_id', [''=>'Izaberite tim'] + $teams->all(), null, ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                    {!! csrf_field() !!}
                    <br>
                    {!! Form::text('display_name', null, ['class'=>'form-control', 'placeholder'=>'Naziv fajla']) !!}
                    <br>
                    {!! Form::file('report') !!}
                    <br>

                    {!! Form::submit('Dodaj', ['class'=>'btn btn-info']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection