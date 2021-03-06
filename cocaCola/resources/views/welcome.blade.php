@extends('layouts.app')

@section('content')
    <div class="container">
        <img class="img-banner" src="image/bakground.png">
        <div class="row">
            <div class="col-md-12 banner">
                @if(Session::has('message'))
                    <p class="alert message {{ Session::get('alert-class', 'alert-danger') }} alert-dismissable">
                        <strong>Info!</strong> {{ Session::get('message') }}</p>
                @endif
                <img class="win-prizes" src="image/win-prizes.png">
                <h1>
                    Join our contests and win beautiful prices!!!
                </h1>

                <div class="col-md-8 prizes">
                    {{--<div class="col-md-12">--}}
                    {{--<h4>Prizes to win</h4>--}}
                    {{--<hr>--}}
                    {{--</div>--}}
                    @for ($i = 1; $i < 7; $i++)
                        <div class="col-lg-4">
                            <a href="{{url('/play-contest')}}"> <img class="{{$i> 3 ? 'prizes-list' : ''}}"
                                                                     src="image/peizes{{$i}}.png"></a>
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
        <div class="row banner-contests">
            <div class="col-md-12 banner">
                <h1>Play <strong>{{count($contests)}}</strong> different dates</h1>

                @foreach($contests as $contest)

                    <div class="col-sm-6 col-md-3 float-left">
                        <div class="thumbnail">
                            <img src="{{url('/image/contests/'.$contest->type.'.png')}}" alt="{{$contest->name}}">
                            <div class="caption">
                                <h3>{{$contest->name}}</h3>
                                <p>This contest starts at {{$contest->date_start}} and end at {{$contest->date_end}}</p>

                            </div>
                        </div>
                    </div>

                @endforeach
                <div class="col-md-12">
                    <p><a href="{{url('/play-contest')}}" class="btn btn-primary" role="button">play current contest</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
