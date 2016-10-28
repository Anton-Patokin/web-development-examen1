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
                </div>
                <div class="col-md-6">
                    <img src="image/code.png">
                </div>
                <div class="col-md-6">

                    {{Form::open(['url' => '/apartisipan-information', 'method' => 'post'])}}

                    <div class="form-group col-md-6">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{ Form::text('code', '', array('class' => 'form-control')) }}
                    </div>
                    @yield('form')
                    {{Form::close() }}
                </div>

            </div>
        </div>
    </div>
@endsection
