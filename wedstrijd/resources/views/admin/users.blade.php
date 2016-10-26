@extends('layouts.app')

@section('content')

    <style>
        .name {
            background-color: #5bc0de;
        }
    </style>
    <div class="container banner-code">
        @if(! empty($contests) && count($contests) > 0)
            <h1>Users</h1>


            @foreach ($contests as  $key => $contest)
                <div class="row name">
                    <div class="col-md-11">
                        <h1>{{$key}} </h1>
                    </div>
                    <div class="col-md-1">
                        <a href="contastant/download_excel/{{$key}}"><span>excel</span></a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Ip</th>
                        <th>name</th>
                        <th>Adres</th>
                        <th>Location</th>
                        <th>Email</th>
                        <th>Delete</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($contest as $index => $contestant)
                        <tr>
                            <td>{{$contestant->ipAdres}}</td>
                            <td>{{$contestant->name}}</td>
                            <td>{{$contestant->adres}}</td>
                            <td>{{$contestant->location}}</td>
                            <td>{{$contestant->email}}</td>
                            <td><a href="contastant/delete/{{$contestant->id}}"><span>delete</span></a></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endforeach

        @else
            <h1>There no contest</h1>
        @endif
    </div>
@endsection