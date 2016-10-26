@extends('layouts.app')

@section('content')

    <div class="container banner-code">
        <h1>Update Contest</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($contest)
            <div class="row">
                <div class="col-md-12">{{Form::open(['url' => 'contest_datums/update/id/'.$contest->id])}}
                    {{Form::token()}}
                    <div class="form-group col-md-6">
                        {{Form::label('contestName', 'Contest name', ['class' => 'awesome'])}}
                        {{ Form::text('contestName', $contest->contestName, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{Form::label('contestDateStart', 'Start date', ['class' => 'awesome'])}}
                        {{Form::date('contestDateStart', $contest->contestDateStart,['class' => 'form-control'])}}
                    </div>
                    <div class="form-group col-md-6">
                        <p>Choose type of contest</p>
                        {{ Form::radio('contestType', 'Code', ($contest->contestType == "Code" ? true : false),['class' => 'field']) }}
                        {{Form::label('contestType', 'Code', ['class' => 'awesome'])}}

                        {{ Form::radio('contestType', 'Foto', ($contest->contestType == "Foto" ? true : false),['class' => 'field']) }}
                        {{Form::label('contestType', 'Foto', ['class' => 'awesome'])}}

                        {{ Form::radio('contestType', 'Google-maps', ($contest->contestType == "Google maps" ? true : false),['class' => 'field']) }}
                        {{Form::label('contestType', 'Google-maps', ['class' => 'awesome'])}}

                        {{ Form::radio('contestType', 'Surprise', ($contest->contestType == "Surprise" ? true : false),['class' => 'field']) }}
                        {{Form::label('contestType', 'Surprise', ['class' => 'awesome'])}}

                    </div>
                    <div class="form-group col-md-6">
                        {{Form::label('contestDateEnd', 'End date', ['class' => 'awesome'])}}
                        {{Form::date('contestDateEnd', $contest->contestDateEnd,['class' => 'form-control'])}}
                    </div>
                    <div class="col-md-12">
                        {{Form::submit('Click Me!',['class' => 'btn btn-primary'])}}
                    </div>
                    {{Form::close() }}
                </div>
            </div>
        @endif
    </div>
@endsection