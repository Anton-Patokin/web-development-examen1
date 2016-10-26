@extends('layouts.app')

@section('content')
    <div class="container">
        <img class="img-banner" src="image/bakground.png">
        <div class="row">
            <div class="col-md-12 banner">
                
                <img class="win-prizes" src="image/win-prizes.png">
                <h1>
                    Play with our contests and win beathefull prices
                </h1>

                <div class="col-md-8 prizes">
                    {{--<div class="col-md-12">--}}
                        {{--<h4>Prizes to win</h4>--}}
                        {{--<hr>--}}
                    {{--</div>--}}
                    @for ($i = 1; $i < 7; $i++)
                        <div class="col-lg-4">
                            <a href="{{url('/play-contest')}}"> <img class="{{$i> 3 ? 'prizes-list' : ''}}" src="image/peizes{{$i}}.png"></a>
                        </div>
                    @endfor

                </div>
                <div class="col-md-4">
                    <h4>Last year winners</h4>
                    <hr>
                    @foreach($partisipants as $partisipant)
                        <p>{{$partisipant->name}}</p>
                    @endforeach
                </div>
                <a href="{{url('/play-contest')}}"><img class="play" src="image/play.png"></a>
            </div>
        </div>
    </div>
@endsection
