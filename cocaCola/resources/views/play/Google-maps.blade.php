@extends('layouts.app')
@section('heading')

    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyAkd49_wxLkclwesSzLODJAkt3VeRvLrug"></script>

    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>



    <script>
        $(document).ready(function () {
            $(".place").hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(function () {
                var map;
                var cons_zoom_closup = 2;


                function initMap() {
                    var myLatLng = {lat: 51.2194475, lng: 4.4024643};
                    init_map(myLatLng.lat, myLatLng.lng, cons_zoom_closup);


//                        google.maps.event.addListener(map, 'click', function (event) {
//                            console.log("place marker event", event.latLng)
//                            placeMarker(event.latLng);
//                        });


                    var mousedUp = false;
                    google.maps.event.addListener(map, 'mousedown', function (event) {
                        var google_location_lat = event.latLng.lat();
                        var google_location_lng = event.latLng.lng();
                        mousedUp = false;
                        setTimeout(function () {
                            if (mousedUp === false) {
                                //do something if the mouse was still down
                                //after 500ms

                                $("#formModal").modal('show');
                                $(".ajax_btn").click(function (e) {
                                    e.preventDefault();
                                    var name = $("input[name='name']").val();
                                    var address = $("input[name='address']").val();
                                    var location = $("input[name='location']").val();
                                    placeMarker(google_location_lat, google_location_lng, name, address, location);
                                })

//                                console.log("google maps long click");
//
                            }
                        }, 1000);
                    });
                    google.maps.event.addListener(map, 'mouseup', function (event) {
                        mousedUp = true;
                    });


                }


                var jqxhr = $.get("play-contest/pins", function () {
                        })
                        .done(function (data) {
                            console.log('pins db', data);
                            if (data) {
                                initialize_markers(data)
                                //initialize();
                            } else {
                                console.log("je bent eerste die het speeld");
                            }
                        })
                        .fail(function () {
                            console.log("error")
                        })

                function initialize_markers(data) {
                    for (i = 0; i < data.length; i++) {
                        var marker, i;
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(data[i].lat, data[i].lng),
                            map: map
                        });
                    }
                }

                function placeMarker(lat, lng, name, address, location_persoon) {


                    $.ajax({
                        url: 'play-contest',
                        type: 'POST',
                        data: {
                            lat: lat,
                            lng: lng,
                            name: name,
                            address: address,
                            location: location_persoon
                        }

//                        success: function (response) {
//                            console.log("post van location is goed doorgekomen", response);
//                        },
//                        error: function () {
//                            console.log("er ging iets fout met post variabelle google maps");
//                        }
                    }).done(function (data) {


                        console.log("post van location is goed doorgekomen", data);

                        if(data.succes){
                            $("#formModal").modal('hide');

                            $(".place").html(data.succes.place).append('<strong>Your distance</strong> <i class="pull-right distance">'+data.succes.distance+'</i>').show();
                            
                        }
                        if (data != "error") {

                            var location = {lat: lat, lng: lng};
                            var marker = new google.maps.Marker({
                                position: location,
                                map: map
                            });
                        }else{
                            $(".error").append("<p class='alert alert-danger'>You may play only once </p>");
                        }


                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        var responseMsg = jQuery.parseJSON(jqXHR.responseText);
                        var errorMsg = 'There was a general problem with your request';
                        if (responseMsg) {
                            $(".error").html("");
                            $.each(responseMsg, function (index, value) {
                                console.log(index + ": " + value);

                                $(".error").append("<p class='alert alert-danger'>" + index + ": " + value + "</p>");
                            });


                        }
                        console.log(responseMsg);
                    });

                }


                function init_map(lat, lng, zoom) {
                    var myLatLng = new google.maps.LatLng(lat, lng);

                    map = new google.maps.Map(document.getElementById('map'), {
                        zoom: zoom,
                        center: myLatLng,
                        disableDefaultUI: true,
                        zoomControl: true,
                        scaleControl: true
                    });
                }

                google.maps.event.addDomListener(window, 'load', initMap);

            });

        })

    </script>

@endsection


@section('content')
    <div class="container banner-code">
        <div class="row panel-cocacola">
            <div class="col-md-12 ">
                <h1>
                    {{$contest->name}}
                </h1>
            </div>
        </div>
        <div class="col-md-12">
            <h1>where you think first coca cola was bottled?</h1>
            <p>Put your pin on google maps, closest 6 people wins. You can set pin on same locations as others</p>
        </div>
        <div id="area" class="col-md-3 top10">
            <h3>10 closest distance</h3>
            <ol>
                @foreach($top10 as $key =>$value)
                   <li><strong>{{$key}}:</strong> <i class="pull-right">{{$value }} km</i> </li>
                @endforeach
                    <div class="place"></div>
            </ol>
        </div>
        <div id="area" class="col-md-9">
            <div id="map"></div>
        </div>
    </div>

    <div class="modal fade" id="formModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Fill your personal information </h4>
                </div>
                <div class="modal-body">
                    <div class="error">

                    </div>

                    {{Form::open(['url' => ''])}}
                    {{Form::token()}}
                    <div class="form-group col-md-12">
                        {{Form::label('name', 'What is your name?', ['class' => 'awesome'])}}
                        {{ Form::text('name', '', array('class' => 'form-control')) }}

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
                        {{Form::submit('Play',['class' => 'btn btn-primary ajax_btn'])}}
                    </div>
                    {{Form::close() }}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
