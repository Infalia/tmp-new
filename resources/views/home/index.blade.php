@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <h1 class="h3 teal-text text-lighten-1">{{ $heading1 }}</h1>
            <p class="h5">{{ $text1 }}</p>

            <div class="row home-options">
                <div class="col m6">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/goods.jpg">
                            <span class="card-title">{{ $heading2 }}</span>
                        </div>
                        
                        <div class="card-content">
                            <p>{{ $text2 }}</p>
                        </div>

                        <div class="card-action">
                            <a href="{{ url('/offers') }}" class="teal-text text-lighten-1">{{ $link1 }}</a>
                        </div>
                    </div>
                </div>

                <div class="col m6">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/services.jpg">
                            <span class="card-title">{{ $heading3 }}</span>
                        </div>

                        <div class="card-content">
                            <p>{{ $text3 }}</p>
                        </div>

                        <div class="card-action">
                            <a href="{{ url('/associations') }}" class="teal-text text-lighten-1">{{ $link2 }}</a>

                            @if ($isAssociation == true)
                            <a href="{{ url('/association/register') }}" class="right teal-text text-lighten-1">{{ $link3 }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jslibs')
    <script>
    </script>
@endsection