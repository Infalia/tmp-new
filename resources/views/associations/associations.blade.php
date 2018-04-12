@extends('layouts.app')

@section('csslibs')
{!! HTML::style('plugins/leaflet/leaflet.css') !!}
{!! HTML::style('plugins/owl/assets/owl.carousel.min.css') !!}
{!! HTML::style('plugins/owl/assets/owl.theme.green.min.css') !!}
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="associations">

                <div class="row">
                    <div class="col s12 xl10 offset-xl1">
                        <h1 class="h3 teal-text text-lighten-1">{{ $heading1 }}</h1>
                    </div>
                </div>

                <div class="row">
                    @forelse($associations as $association)
                    <div class="col s12 xl10 offset-xl1">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col m4 push-m8 l3 push-l9 xl2 push-xl10">
                                        @if($association->images->isNotEmpty())
                                        <div class="card-image---">
                                        {!! HTML::image('storage/associations/'.$association->images->first()->name, $association->title, array('class' => 'responsive-img')) !!}
                                        </div>
                                        @endif
                                    </div>

                                    <div class="col m8 pull-m4 l9 pull-l3 xl10 pull-xl2">
                                        <span class="card-title">{{ $association->title }}</span>

                                        @isset($association->address)
                                        <span class="card-post-address">{{ $association->address }}</span>
                                        @endisset

                                        <div class="card-assoc-contacts">
                                            <ul>
                                                <li class="card-assoc-contact">
                                                    <span class="assoc-phone">
                                                        @isset($association->phone_1)
                                                        {{ $association->phone_1 }}
                                                        @endisset

                                                        @isset($association->phone_2)
                                                        <br>{{ $association->phone_2 }}
                                                        @endisset
                                                    </span>
                                                </li>

                                                @isset($association->email)
                                                <li class="card-assoc-contact"><a href="mailto:{{ $association->email }}" class="assoc-email">{{ $association->email }}</a></li>
                                                @endisset

                                                @isset($association->website)
                                                @if(!preg_match("~^(?:f|ht)tps?://~i", $association->website))
                                                <li class="card-assoc-contact"><a href="http://{{ $association->website }}" class="assoc-website" target="_blank">{{ $association->website }}</a></li>
                                                @else
                                                <li class="card-assoc-contact"><a href="{{ $association->website }}" class="assoc-website" target="_blank">{{ $association->website }}</a></li>
                                                @endif
                                                @endisset
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="right-align">
                                    <a class="waves-effect waves-light btn modal-trigger" href="#modal-{{ $association->id }}">{{ $detailsBtn }}</a>

                                    <div id="modal-{{ $association->id }}" class="modal modal-fixed-footer left-align" data-id="{{ $association->id }}">
                                        <div class="modal-content">
                                            <div class="row">
                                                <div class="col s12 l6 xl5">
                                                    <h2 class="h5">{{ $association->title }}</h2>

                                                    @isset($association->address)
                                                    <span class="card-post-address">{{ $association->address }}</span>
                                                    @endisset

                                                    <div class="card-assoc-contacts">
                                                        <ul>
                                                            <li class="card-assoc-contact">
                                                                <span class="assoc-phone">
                                                                    @isset($association->phone_1)
                                                                    {{ $association->phone_1 }}
                                                                    @endisset

                                                                    @isset($association->phone_2)
                                                                    <br>{{ $association->phone_2 }}
                                                                    @endisset
                                                                </span>
                                                            </li>

                                                            @isset($association->email)
                                                            <li class="card-assoc-contact"><a href="mailto:{{ $association->email }}" class="assoc-email">{{ $association->email }}</a></li>
                                                            @endisset

                                                            @isset($association->website)
                                                            @if(!preg_match("~^(?:f|ht)tps?://~i", $association->website))
                                                            <li class="card-assoc-contact"><a href="http://{{ $association->website }}" class="assoc-website" target="_blank">{{ $association->website }}</a></li>
                                                            @else
                                                            <li class="card-assoc-contact"><a href="{{ $association->website }}" class="assoc-website" target="_blank">{{ $association->website }}</a></li>
                                                            @endif
                                                            @endisset
                                                        </ul>
                                                    </div>

                                                </div>

                                                <div class="col s12 l6 xl7">
                                                    <div id="map-{{ $association->id }}" class="map input-map" data-lat="{{ $association->latitude }}" data-long="{{ $association->longitude }}" data-title="{{ $association->title }}"></div>
                                                </div>
                                            </div>


                                            @isset($association->description)
                                            <h3 class="h5">{{ $heading2 }}</h3>
                                            <div>{!! nl2br(e($association->description)) !!}</div>
                                            @endisset
                                            

                                            @if($association->images->isNotEmpty())
                                            <div class="owl-carousel owl-theme">
                                                @foreach ($association->images as $image)
                                                <div class="item carousel-item">
                                                    {!! HTML::image('storage/associations/'.$image->name, $association->title, array('class' => '')) !!}
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">{{ $closeBtn }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @isset($association->description)
                            <div class="card-action card-assoc-description">{!! nl2br(e($association->description)) !!}</div>
                            @endisset
                        </div>
                    </div>
                    @empty
                        <div class="col s12 xl10 offset-xl1">
                            <p>{{ $noRecordsMsg }}</p>
                        </div>
                    @endforelse

                </div>

                {{ $associations->links('vendor.pagination.default') }}

            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    {!! HTML::script('plugins/owl/owl.carousel.min.js') !!}
    {!! HTML::script('plugins/leaflet/leaflet.js') !!}

    <script>
        

        $(document).ready(function() {
            var map = null;

            $('.modal').modal({
                ready: function(modal, trigger) {
                    var itemId = modal.attr('data-id');

                    var lat = $('#map-' + itemId).attr('data-lat');
                    var lng = $('#map-' + itemId).attr('data-long');
                    var title = $('#map-' + itemId).attr('data-title');
                    var zoom = 10;
                    markerImg = "{{ config('app.url') }}/images/marker.png";


                    var points = new Array();
                    map = L.map('map-' + itemId).setView([lat, lng], zoom);
                    mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';

                    //L.tileLayer('https://api.mapbox.com/styles/v1/drp0ll0/cj0tausco00tb2rt87i5c8pi0/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZHJwMGxsMCIsImEiOiI4bUpPVm9JIn0.NCRmAUzSfQ_fT3A86d9RvQ', {
                    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; ' + mapLink + ' Contributors',
                        maxZoom: 18,
                    }).addTo(map);


                    var icon = L.icon({
                        iconUrl: markerImg
                    });

                    marker = new L.marker([lat, lng], {
                        icon: icon
                    })
                    .bindPopup(title)
                    .addTo(map);





                    $('.owl-carousel').owlCarousel({
                        margin: 5,
                        autoWidth: true,
                        responsive: {
                            // breakpoint from 0 up
                            0 : {
                                items: 1
                            },
                            // breakpoint from 480 up
                            480 : {
                                items: 2
                            },
                            // breakpoint from 768 up
                            768 : {
                                items: 3
                            }
                            // breakpoint from 1024 up
                        //    1024 : {
                        //        items: 4
                        //    },
                            // breakpoint from 1200 up
                        //    1200 : {
                        //        items: 5
                        //    },
                            // breakpoint from 1400 up
                        //    1400 : {
                        //        items: 6
                        //    }
                        }
                    });


                },
                complete: function() {
                    if(map !== undefined || map !== null) {
                        map.remove();
                    }
                }
            });
        });
    </script>
@endsection
