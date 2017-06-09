@extends('layouts.custom')

@section('content')
    <style type="text/css">
        .user-row {
            margin-bottom: 14px;
        }

        .user-row:last-child {
            margin-bottom: 0;
        }

        .dropdown-user {
            margin: 13px 0;
            padding: 5px;
            height: 100%;
        }

        .dropdown-user:hover {
            cursor: pointer;
        }

        .table-user-information > tbody > tr {
            border-top: 1px solid rgb(221, 221, 221);
        }

        .table-user-information > tbody > tr:first-child {
            border-top: 0;
        }


        .table-user-information > tbody > tr > td {
            border-top: 0;
        }
        .toppad
        {
            margin-top:20px;
            margin-left: 15px;
        }
    </style>
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
                {{--<a href="{{url('/users/create')}}" class="btn btn-info">Dodaj člana</a>--}}
            @endif
        </div>
    </div>
    <div class="col-lg-6 pull-left">
        <div class="row">
            <div class="toppad" >
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$user->name}}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{url($user->image)}}" class="img-circle img-responsive"> </div>

                            <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                              <dl>
                                <dt>DEPARTMENT:</dt>
                                <dd>Administrator</dd>
                                <dt>HIRE DATE</dt>
                                <dd>11/12/2013</dd>
                                <dt>DATE OF BIRTH</dt>
                                   <dd>11/12/2013</dd>
                                <dt>GENDER</dt>
                                <dd>Male</dd>
                              </dl>
                            </div>-->
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Tim:</td>
                                        <td>{{$user->team->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Rodjendan</td>
                                        <td>{{date('d.m.Y',strtotime($user->birthday))}}</td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>Telefon:</td>
                                        <td>{{$user->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td>Home Address</td>
                                        <td>Kathmandu,Nepal</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                    </tr>
                                    </tr>

                                    </tbody>
                                </table>

                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#profile">Izmeni profil</button>
                                 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#passwordChange">Izmeni šifru</button>
                                <!-- <a href="#" class="btn btn-primary">Team</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        {{--<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>--}}
                        {{--<span class="pull-right">--}}
                            {{--<a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>--}}
                            {{--<a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>--}}
                        {{--</span>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 ">
        <h2>Aktivnosti</h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Naziv aktivnosti</th>
                    <th>Oblast</th>
                    <th>Broj bodova</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach($user->activities as $activity)
                <tr>
                    <td>{{$activity->name}}</td>
                    <td>{{$activity->team->name}}</td>
                    <td>{{$activity->points}}</td>
                </tr>
                    @php
                        $total += $activity->points;
                    @endphp
                @endforeach
                <tr>
                    <td>Total:</td>
                    <td></td>
                    <td>{{$total}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Dodaj aktivnost</button> -->
    </div>

    <!-- Modal -->
    {{--<div id="myModal" class="modal fade" role="dialog">--}}
        {{--<div class="modal-dialog">--}}

            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                    {{--<h4 class="modal-title">Dodaj aktivnost</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--{!! Form::open(['method'=>'post', 'action'=>'UsersController@userActivityStore']) !!}--}}
                    {{--{!! Form::select('activity', [''=>'Izaberite aktivnost'] + $activities->all(), null, ['class'=>'form-control', 'style'=>'width:100%;']) !!}--}}
                    {{--<br>--}}
                    {{--<input type="hidden" name="user" value="{{$user->id}}">--}}
                    {{--{!! Form::submit('Dodaj', ['class'=>'btn btn-info']) !!}--}}
                    {{--{!! Form::close() !!}--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}

    <!-- Modal -->
    <div id="profile" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Izmeni profil</h4>
                </div>
                <div class="modal-body">
                    {!! Form::model($user, ['method'=>'patch', 'action'=>['ProfileController@update', $user->id], 'files'=>true]) !!}
                    {!! csrf_field()!!}
                    <div class="form-group">
                        <label>Ime i prezime</label>
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label>Rođendan</label>
                        {!! Form::date('birthday', \Carbon\Carbon::parse($user->birthday), ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label>Telefon</label>
                        {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        {!! Form::email('email', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Slika</label>
                        {!! Form::file('image') !!}
                    </div>
                    {!! Form::submit('Sačuvaj', ['class'=>'btn btn-info']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


     <div id="passwordChange" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Promena šifre</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::model($user, ['method'=>'patch', 'action'=>['ProfileController@passwordUpdate', $user->id], 'class'=>'form-vertical']) !!}
                                {!! Form::password('old_password', ['class'=>'form-control', 'placeholder'=>'Unesite staru šifru']) !!}<br>
                                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Unesite novu šifru']) !!}<br>
                                {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Ponovite novu šifru']) !!}<br>
                                {!! Form::submit('Sačuvaj', ['class'=>'btn btn-success']) !!}
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
    <script type="text/javascript" src="{{url('js/select2/dist/js/select2.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select').select2();
        })
    </script>
@endsection