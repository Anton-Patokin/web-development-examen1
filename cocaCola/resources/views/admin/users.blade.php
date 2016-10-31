@extends('layouts.app')

@section('content')

    <style>
        .name {
            background-color: #5bc0de;
        }
    </style>
    <div class="container banner-code">
        @if(! empty($contest))
            <h1>Users</h1>



            <div class="row name">
                <div class="col-md-11">
                    <h1>{{$contest->name}} </h1>
                </div>
                <div class="col-md-1">
                    <a href="download_excel/{{$contest->id}}"><span>excel</span></a>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Ip</th>
                    <th>name</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>Email</th>
                    <th>Delete</th>


                </tr>
                </thead>
                <tbody>
                @if( ! empty($participants))
                    @foreach ($participants as $participant)
                        <tr>
                            <td>{{$participant->ipAdres}}</td>
                            <td>{{$participant->name}}</td>
                            <td>{{$participant->adres}}</td>
                            <td>{{$participant->location}}</td>
                            <td>{{$participant->email}}</td>
                            <td><a href="{{ url('/contastant/delete/'.$participant->id) }}"><span>delete</span></a></td>

                        </tr>

                    @endforeach
                    {{ $participants->links() }}
                @endif
                </tbody>
            </table>

        @else
            <h1>There no contest</h1>
        @endif
    </div>
@endsection