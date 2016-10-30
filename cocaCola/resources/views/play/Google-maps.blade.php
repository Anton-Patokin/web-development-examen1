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
            $(function () {
                var map;
                var cons_zoom_closup = 12;


                function initMap() {
                    var myLatLng = {lat: 51.2194475, lng: 4.4024643};
                    init_map(myLatLng.lat, myLatLng.lng, cons_zoom_closup);

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
        <div class="col-md-12">
            <div id="map"></div>
        </div>
    </div>
@endsection
