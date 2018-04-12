@extends('layouts.app')

@section('content')
    <div class="content">
        {{--  @if(Auth::check())
            @include('partials.sidebar')
        @endif  --}}

        <div class="profile-container">
            <div class="row">
                <div class="col s12">
                    <h1 class="h4">{{ $profileBasicHeading1 }}</h1>
                
                    <div>{{ $pageBodyText1 }}</div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    <script>
        
    </script>
@endsection
