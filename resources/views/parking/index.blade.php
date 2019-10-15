@extends('layouts.dashboard' , [ 'title' => 'Home' , 'name' => 'Home' ])
@section('css')
    <style>
        #map {
            width: 100%;
            height: 70vh;
        }

        #map-side-panel {
            transition: all .5s ease-in-out;
        }

        .side-panel-map {
            width: 0;
        }

        .side-panel-map-open {
            width: 40%
        }
    </style>
@endsection
@section('content')
    <div style="position: relative;height: 70vh" class="">
        <div style="z-index: 95;position: absolute;bottom: 0;top: 0;right: 0;left: 0;background-color: rgba(0,0,0,0.5)" id="map-overlay" class="d-none"></div>
        <div id="map-side-panel" class="bg-white border-bottom side-panel-map" style="position: absolute;top: 0;bottom: 0;right: 0;z-index: 99;height: 100%;overflow-x: scroll">
            <div class="p-5 border-bottom d-flex align-items-center">
                <h4 class="m-0 mr-auto">Parking Booking</h4>
                <i id="map-side-panel-close" style="font-size: 20px;cursor: pointer" class="fe fe-x"></i>
            </div>
            <div id="side-panel-content-container" style="height: calc(100% - 80px);" class="dimmer">
                <div class="loader"></div>
                <div id="side-panel-content" class="dimmer-content">

                </div>
            </div>
        </div>
        <div id="" class="bg-white  shadow-lg rounded" style="width:400px;position: absolute;top: 10px;left: 0;right: 0;z-index: 90;margin-left: auto;margin-right: auto">
            <form class="input-icon">
                <input value="{{ old('search' , request()->get('search')) }}" type="search" name="search" class="form-control header-search py-3 pl-5 border-0" placeholder="Search…" tabindex="1">
                <div class="input-icon-addon pr-5">
                    <i class="fe fe-search"></i>
                </div>
            </form>
        </div>
        <div id="map" class="border-bottom"></div>
        <div style="margin-top: -57px" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Parking</h3>
                            <form method="get" class="card-options">
                                <div>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" name="reserved" value="true" {{ request()->get('reserved')  ? 'checked' : ''}}>
                                        <span class="custom-control-label">Reserved</span>
                                    </label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" name="occupied" value="true" {{ request()->get('occupied')  ? 'checked' : ''}}>
                                        <span class="custom-control-label">Occupied</span>
                                    </label>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" name="available" value="true" {{ request()->get('available')  ? 'checked' : ''}}>
                                        <span class="custom-control-label">Available</span>
                                    </label>
                                </div>
                                <div>
                                    <div class="input-group ">
                                        <input value="{{ old('search' , request()->get('search')) }}" type="text" class="form-control form-control-sm" placeholder="Search something..." name="search">
                                        <span class="input-group-btn ml-2">
                                        <button class="btn btn-sm btn-default" type="submit">
                                          <span class="fe fe-filter"></span>
                                        </button>
                                      </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-striped table-vcenter">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Road</th>
                                    <th>City</th>
                                    <th>Activity</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $location)
                                    <tr>
                                        <td>
                                            <span class="avatar avatar-{{ $location->occupied ? 'red' : ( $location->reserved ? 'orange' : 'green' ) }}">{{ $location->occupied ? 'O' : ( $location->reserved ? 'R' : 'A' ) }}</span>
                                        </td>
                                        <td>{{ $location->name }}</td>
                                        <td>{{ $location->road }}</td>
                                        <td>{{ $location->city }}</td>
                                        <td>{{ $location->updated_at->diffForHumans() }}</td>
                                        <td class="text-center w-1"><a href="#" data-id="{{ $location->id }}" class="icon map-location-view"><i class="fe fe-eye"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pt-6 d-flex justify-content-center">
                            {{ $list->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function openViewMarker(id) {

            $("#side-panel-content-container").addClass('active');
            $("#map-side-panel").addClass("side-panel-map-open");
            $("#map-overlay").removeClass("d-none");

            $.get("/parking/" + id + "/create", function( data ) {
                console.log(data);
                $("#side-panel-content-container").removeClass('active');
                $("#side-panel-content").html(data);

                $("#enquire-form").on('submit' , function (e) {
                    e.preventDefault();
                    $("#side-panel-content-container").addClass('active');
                    let n = $(this);
                    $.ajax({
                        type: "POST",
                        url: "/parking/" + id + "/create",
                        data: n.serialize(),
                        success: function(t) {
                            $("#side-panel-content").html(t);
                            $("#confirm-form").on('submit' , function (e) {
                                let form = $(this);
                                e.preventDefault();
                                $("#side-panel-content-container").addClass('active');
                                $.ajax({
                                    type: "POST",
                                    url: form.attr("action"),
                                    data: n.serialize(),
                                    success: function(g) {
                                        $("#side-panel-content").html(g);

                                    },
                                    complete: function() {
                                        $("#side-panel-content-container").removeClass('active');
                                    }
                                });

                            });

                        },
                        complete: function() {
                            $("#side-panel-content-container").removeClass('active');
                        }
                    });
                });

            });
        }

        $(document).ready(function () {
            $('.map-location-view').click(function (e) {
                e.preventDefault();
                openViewMarker($(this).attr('data-id'));
            });

            $('#map-side-panel-close').click(function () {
                $("#map-side-panel").removeClass("side-panel-map-open");
                $("#map-overlay").addClass("d-none");
            });
        });



        var map;
        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 18,
                //-19.517569, 29.836276
                center: {lat: -19.517569, lng: 29.836276},
                styles : [
                    {
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#242f3e"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#746855"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#242f3e"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.locality",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#d59563"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#d59563"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#263c3f"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#6b9a76"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#38414e"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#212a37"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9ca5b3"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#746855"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#1f2835"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#f3d19c"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#2f3948"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.station",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#d59563"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#17263c"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#515c6d"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#17263c"
                            }
                        ]
                    }
                ]
            });

             @foreach( $locations  as $loc )
               new google.maps.Marker({
                     position: {
                         lat : {{ $loc->lat }},
                         lng : {{ $loc->long }},
                     },
                     {{--label : '{{ $loc->name }}',--}}
                     icon: {
                         url: 'https://cdn.mapmarker.io/api/v1/font-awesome/v5/icon-stack?size=35&color={{ $loc->occupied ? 'ff0000' : ( $loc->reserved ? 'ff7400' : '809c13' ) }}&icon=fa-circle'
                     }
                    , map: map}).addListener('click', function() {
                        openViewMarker({{ $loc->id }});
                     });

            @endforeach

        }


    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFAJGePt3ihtFO8apbUeeAtoGBh0STLvo&callback=initMap" async defer></script>


@endsection
