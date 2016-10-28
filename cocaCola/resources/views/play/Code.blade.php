@extends('layouts.app')

@section('content')
    <div class="container banner-code">

        <div class="row ">
            <div class="col-md-12 ">

                <div class="col-md-12">
                    <h1>
                        Enter the code
                    </h1>
                    <hr>
                    @if(Session::has('succes'))
                        <p class="alert message  {{ Session::get('alert-class', 'alert-success') }} alert-dismissable">{{ Session::get('succes') }}</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <img src="image/code.png">
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                    <div class="col-md-12">
                        {{Form::open(['url' => 'play_contest/code'])}}
                        {{Form::token()}}
                        <div class="form-group col-md-12">
                            {{Form::label('code', 'Fill the code - 6 characters', ['class' => 'awesome'])}}
                            {{ Form::text('code', '', array('class' => 'form-control')) }}
                        </div>
                        <div class="form-group col-md-12">
                            {{Form::label('name', 'What is your name?', ['class' => 'awesome'])}}
                            {{ Form::text('name', '', array('class' => 'form-control')) }}
                        </div>
                        <div class="form-group col-md-12">
                            {{Form::label('email', 'What is your email address', ['class' => 'awesome'])}}
                            {{ Form::text('email', '', array('class' => 'form-control')) }}
                        </div>
                        <div class="form-group col-md-12">
                            {{Form::label('address', 'What is your address?', ['class' => 'awesome'])}}
                            {{ Form::text('address', '', array('class' => 'form-control')) }}
                        </div>
                        <div class="form-group col-md-12">
                            {{Form::label('location', 'What is your location', ['class' => 'awesome'])}}
                            {{ Form::text('location', '', array('class' => 'form-control')) }}
                        </div>
                        <div class="col-md-12">
                            {{Form::submit('Play',['class' => 'btn btn-primary'])}}
                        </div>
                        {{Form::close() }}
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
