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
                <button class="btn btn-info" data-toggle="modal" data-target="#myModal">Dodaj sastanak</button>
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
                        <th>Lokacija</th>
                        <th>Datum</th>
                        <th></th>
                        @if(Auth::user()->isAdmin())
                            <th></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($team->meetings as $meeting)
                        <tr>
                            <td>{{$meeting->name}}</td>
                            <td>{{$meeting->location}}</td>
                            <td>{{$meeting->created_at}}</td>
                            <td><a class="btn btn-info" href="{{url('meetings/' . $meeting->id)}}" >Prikaži</a></td>
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
        </div>
    @endforeach

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Dodaj sastanak</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method'=>'post', 'action'=>'MeetingController@store', 'files'=>true]) !!}
                    {!! Form::select('team_id', [''=>'Izaberite tim'] + $teams->all(), null, ['class'=>'form-control', 'id'=>'team','style'=>'width:100%;']) !!}
                    {!! csrf_field() !!}
                    <br>
                    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Naziv']) !!}
                    <br>
                    {!! Form::text('location', null, ['class'=>'form-control', 'placeholder'=>'Lokacija']) !!}
                    <br>
                    <div id="users">

                    </div>
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

@section('footer')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#team').on('change', function () {
                $('#users').empty();
                var team_id = $('#team').val();

                $.ajax({
                    url:'{{url('teams-change')}}',
                    method: 'get',
                    data: {team_id: team_id},
                    success: function (data) {
                        $('#users').append('Prisustvovali: <br>');
                        for(var i = 0; i < data.length; i++){
                            $('#users').append('<input type="checkbox" name="users[]" value="'+data[i]['id']+'">'+data[i]['name'] +'<br>')
                        }
                        $('#users').append('<br>');
                    }


                });
            });
        });
    </script>
@endsection