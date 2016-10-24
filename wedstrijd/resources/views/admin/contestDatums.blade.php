@extends('layouts.app')

@section('content')

    @if($contests)
        <table class="table">
            <thead>
            <tr>
                <th>Contest name</th>
                <th>Start date</th>
                <th>End fate</th>
                <th>Contest type
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($contests as $contest)
                <tr>
                    <td>{{$contest->contestName}}</td>
                    <td>{{$contest->contestDateStart}}</td>
                    <td>{{$contest->contestDateEnd}}</td>
                    <td>{{$contest->contestType}}</td>
                    <td><a href="contest_datums/update/{{$contest->id}}"><span>Update</span></a></td>
                    <td><a href="contest_datums/delete/{{$contest->id}}"><span>Delete</span></a></td>

                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1>Add contest</h1>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(count($contests) < 4)
        <div class="row">
            <div class="col-md-12">{{Form::open(['url' => 'contest_datums'])}}
                {{Form::token()}}
                <div class="form-group col-md-6">
                    {{Form::label('contestName', 'Contest name', ['class' => 'awesome'])}}
                    {{ Form::text('contestName', '', array('class' => 'form-control')) }}
                </div>
                <div class="form-group col-md-6">
                    {{Form::label('contestDateStart', 'Start date', ['class' => 'awesome'])}}
                    {{Form::date('contestDateStart', \Carbon\Carbon::now()->format('d-m-Y'),['class' => 'form-control'])}}
                </div>
                <div class="form-group col-md-6">
                    <p>Choose type of contest</p>
                    {{ Form::radio('contestType', 'Code', true,['class' => 'field']) }}
                    {{Form::label('contestType', 'Code', ['class' => 'awesome'])}}

                    {{ Form::radio('contestType', 'Foto', false,['class' => 'field']) }}
                    {{Form::label('contestType', 'Foto', ['class' => 'awesome'])}}

                    {{ Form::radio('contestType', 'Google maps', false,['class' => 'field']) }}
                    {{Form::label('contestType', 'Google maps', ['class' => 'awesome'])}}

                    {{ Form::radio('contestType', 'Surprise', false,['class' => 'field']) }}
                    {{Form::label('contestType', 'Surprise', ['class' => 'awesome'])}}

                </div>
                <div class="form-group col-md-6">
                    {{Form::label('contestDateEnd', 'End date', ['class' => 'awesome'])}}
                    {{Form::date('contestDateEnd', \Carbon\Carbon::now()->format('d-m-Y'),['class' => 'form-control'])}}
                </div>
                <div class="col-md-12">
                    {{Form::submit('Click Me!',['class' => 'btn btn-primary'])}}
                </div>
                {{Form::close() }}
            </div>
        </div>
        @endif



@endsection