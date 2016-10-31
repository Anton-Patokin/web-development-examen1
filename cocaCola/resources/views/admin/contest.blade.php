@extends('layouts.app')

@section('content')
<div class="container banner-code">
    @if(! empty($contests) && count($contests) > 0)
        <h1>Contests</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Contest name</th>
                <th>Start date</th>
                <th>End fate</th>
                <th>Contest type</th>
                <th>Email</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($contests as $contest)
                <tr>
                    <td><a href="{{ url('/contastant/'.$contest->id)}}">{{$contest->name}}</a></td>
                    <td>{{$contest->date_start}}</td>
                    <td>{{$contest->date_end}}</td>
                    <td>{{$contest->type}}</td>
                    <td>{{$contest->email}}</td>
                    <td><a href="contest_datums/update/{{$contest->id}}"><span>Update</span></a></td>
                    <td><a href="contest_datums/delete/{{$contest->id}}"><span>Delete</span></a></td>

                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1>Add contest</h1>
    @endif

    <hr>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable"> {{ Session::get('message') }}</p>
    @endif

    @if(count($contests) < 4)
        <div class="row">
            <div class="col-md-12">
                {{Form::open(['url' => 'contest_datums'])}}
                {{Form::token()}}
                <div class="form-group col-md-6">
                    {{Form::label('contestName', 'Contest name', ['class' => 'awesome'])}}
                    {{ Form::text('contestName', '', array('class' => 'form-control')) }}
                </div>
                <div class="form-group col-md-6">
                    {{Form::label('contestDateStart', 'Start date', ['class' => 'awesome'])}}
                    {{Form::date('contestDateStart', \Carbon\Carbon::now(),['class' => 'form-control'])}}
                </div>
                <div class="form-group col-md-6">
                    <p>Choose type of contest</p>
                    {{ Form::radio('contestType', 'Code', true,['class' => 'field']) }}
                    {{Form::label('contestType', 'Code', ['class' => 'awesome'])}}

                    {{ Form::radio('contestType', 'Foto', false,['class' => 'field']) }}
                    {{Form::label('contestType', 'Foto', ['class' => 'awesome'])}}

                    {{ Form::radio('contestType', 'Google-maps', false,['class' => 'field']) }}
                    {{Form::label('contestType', 'Google-maps', ['class' => 'awesome'])}}

                    {{ Form::radio('contestType', 'Surprise', false,['class' => 'field']) }}
                    {{Form::label('contestType', 'Surprise', ['class' => 'awesome'])}}


                </div>
                <div class="form-group col-md-6">
                    {{Form::label('contestDateEnd', 'End date', ['class' => 'awesome'])}}
                    {{Form::date('contestDateEnd', \Carbon\Carbon::now(),['class' => 'form-control'])}}
                </div>
                <div class="form-group col-md-6">
                    {{Form::label('email', 'email to send updates to', ['class' => 'awesome'])}}
                    {{ Form::text('email', '', array('class' => 'form-control')) }}
                </div>
                <div class="col-md-12">
                    {{Form::submit('Add',['class' => 'btn btn-primary'])}}
                </div>
                {{Form::close() }}
            </div>
        </div>
        @endif


</div>
@endsection