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
                        {{ Form::text('contestName', $contest->name, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{Form::label('contestDateStart', 'Start date', ['class' => 'awesome'])}}
                        {{Form::date('contestDateStart', $contest->date_start,['class' => 'form-control'])}}
                    </div>
                    <div class="form-group col-md-6">
                        <p>Choose type of contest</p>
                        {{ Form::radio('contestType', 'Code', ($contest->type == "Code" ? true : false),['class' => 'field']) }}
                        {{Form::label('contestType', 'Code', ['class' => 'awesome'])}}

                        {{ Form::radio('contestType', 'Foto', ($contest->type == "Foto" ? true : false),['class' => 'field']) }}
                        {{Form::label('contestType', 'Foto', ['class' => 'awesome'])}}

                        {{ Form::radio('contestType', 'Google-maps', ($contest->type == "Google-maps" ? true : false),['class' => 'field']) }}
                        {{Form::label('contestType', 'Google-maps', ['class' => 'awesome'])}}

                        {{ Form::radio('contestType', 'Surprise', ($contest->type == "Surprise" ? true : false),['class' => 'field']) }}
                        {{Form::label('contestType', 'Surprise', ['class' => 'awesome'])}}

                    </div>
                    <div class="form-group col-md-6">
                        {{Form::label('contestDateEnd', 'End date', ['class' => 'awesome'])}}
                        {{Form::date('contestDateEnd', $contest->date_end,['class' => 'form-control'])}}
                    </div>
                    <div class="form-group col-md-6">
                        {{Form::label('email', 'email to send updates to', ['class' => 'awesome'])}}
                        {{ Form::text('email', $contest->email, array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-12">
                        {{Form::submit('Update',['class' => 'btn btn-primary'])}}
                    </div>
                    {{Form::close() }}
                </div>
            </div>
        @endif
    </div>
@endsection