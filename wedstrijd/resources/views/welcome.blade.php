@extends('layouts.app')

@section('content')
    <div class="container">
        <img class="img-banner" src="image/bakground.png">
        <div class="row">
            <div class="col-md-12 banner">
                <h1>
                    Play with our contests and win beathefull prices
                </h1>

                <div class="col-md-8 prizes">
                    <h4>Prizes to win</h4>
                    <hr>
                </div>
                <div class="col-md-4">
                    <h4>Last year winners</h4>
                    <hr>
                    @foreach($partisipants as $partisipant)
                        <p>{{$partisipant->name}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
