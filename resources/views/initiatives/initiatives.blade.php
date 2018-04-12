@extends('layouts.app')

@section('content')
    <div class="content">
        {{--  <div class="container">  --}}
            <div class="initiatives">

                @if(Auth::check())
                <div class="row">
                    <div class="col s12">
                        <a class="waves-effect waves-light btn" href="{{ url('offer/new') }}"><i class="material-icons left">add</i> {{ $postBtn }}</a>
                    </div>
                </div>
                @endif

                <div class="row masonry-cols">
                    @forelse($initiatives as $initiative)
                    <div class="col s12 m6 l4 xl3 masonry-col">
                        <div class="card">
                            
                            <div class="card-image">
                                <a href="{{ url('offer/'.$initiative->id.'/'.str_slug($initiative->title)) }}">
                                    @if($initiative->images->isNotEmpty())
                                    {!! HTML::image('storage/initiatives/'.$initiative->images->first()->name, $initiative->title, array('class' => '')) !!}
                                    @else
                                    {!! HTML::image('images/placeholder.png', $initiative->title, array('class' => '')) !!}
                                    @endif
                                    
                                    @if(Auth::check() && Auth::id() == $initiative->user->id)
                                    <a class="waves-effect waves-light btn" href="{{ url('offer/edit/'.$initiative->id.'/'.str_slug($initiative->title)) }}"><i class="material-icons left">mode_edit</i> {{ $editBtn }}</a>
                                    @endif
                                </a>
                            </div>
                            

                            <div class="card-content">
                                <h5 class="initiative-title">
                                    <a href="{{ url('offer/'.$initiative->id.'/'.str_slug($initiative->title)) }}">{{ $initiative->title }}</a>
                                </h5>

                                <div class="initiative-info">
                                    <span class="initiative-type">{{ $initiative->initiativeType->name }}</span>
                                    <span class="initiative-created grey-text text-darken-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->created_at)->diffForHumans() }}</span>
                                    <span>- by {{ $initiative->user->name }}</span>
                                </div>

                                <div class="initiative-info">
                                    @isset($initiative->start_date)
                                    <span class="initiative-start-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->start_date)->format('l, j M Y H:i') }}</span>
                                    @endisset
                                    
                                    @isset($initiative->address)
                                    <span class="initiative-address">{{ $initiative->address }}</span>
                                    @endisset
                                </div>
                            </div>


                            <div class="card-action card-action-footer">
                                <span class="initiative-engagement"><i class="material-icons tiny inline-icon grey-text text-darken-3">comment</i> {{ $comments = $initiative->comments->count() }} {{ $comments == 1 ? $commentSingularLbl : $commentPluralLbl }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                        <p>{{ $noRecordsMsg }}</p>
                    @endforelse

                </div>
            </div>
        {{--  </div>  --}}

    </div>
@endsection

@section('jslibs')
    <script src="plugins/image-load/imagesloaded.pkgd.min.js"></script>
    <script src="plugins/masonry/masonry.pkgd.min.js"></script>
    <script>
        // Masonry settings
        var $container = $('.masonry-cols');

        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.masonry-col'
            });
        });
    </script>
@endsection
