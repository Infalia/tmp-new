@extends('layouts.app')

@section('csslibs')
    {!! HTML::style('plugins/owl/assets/owl.carousel.min.css') !!}
    {!! HTML::style('plugins/owl/assets/owl.theme.green.min.css') !!}
    {!! HTML::style('plugins/baguettebox/baguetteBox.min.css') !!}
    {!! HTML::style('plugins/jquery-comments/jquery-comments.css') !!}
    {!! HTML::style('plugins/leaflet/leaflet.css') !!}
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="initiative">
                @if(!empty($initiative))

                
                <div class="row">
                    @if(Auth::check() && Auth::id() == $initiative->user->id)
                    <div class="col s12 right-align" style="margin-bottom: 10px;">
                        <a class="waves-effect waves-light btn" href="{{ url('offer/edit/'.$initiative->id.'/'.str_slug($initiative->title)) }}">{{ $editBtn }}</a>
                        {!! Form::button($deleteBtn, array('id' => 'delete-btn', 'class' => 'btn waves-effect waves-light red darken-1', 'onclick' => 'confirmDelete()')) !!}
                    </div>
                    @endif

                    <div class="col s12 l6">
                        <h1 class="h5 initiative-title">{{ $initiative->title }}</h1>

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

                    <div class="col s12 l6">
                        <div id="map" class="input-map"></div>
                    </div>
                </div>


                @isset($initiative->description)
                <div class="initiative-descr">
                    <h3 class="h5">{{ $heading1 }}</h3>
                    <p>{!! nl2br(e($initiative->description)) !!}</p>
                </div>
                @endisset


                <div class="row">
                    <div class="col s12">
                        @if(!empty($initiative->images))
                        <div class="owl-carousel owl-theme">
                            @foreach ($initiative->images as $image)
                            <div class="item carousel-item">
                                <a href="{{ env('APP_URL') }}/storage/initiatives/{{ $image->name }}" data-caption="{{ $initiative->title }}">
                                    {!! HTML::image('storage/initiatives/'.$image->name, $initiative->title, array('class' => '')) !!}
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>


                


                <div class="initiative-engagements">
                    <span class="initiative-engagement"><i class="material-icons tiny inline-icon grey-text text-darken-3">comment</i> {{ $comments = $initiative->comments->count() }} {{ $comments == 1 ? $commentSingularLbl : $commentPluralLbl }}</span>
                </div>

                <div class="divider"></div>

                <div class="comments-container"></div>
                

                @else
                    <p>{{ $noRecordsMsg }}</p>
                @endif
            </div>
        </div>


        <div class="loader-overlay">
            <div class="loader">
                <div class="loader-inner line-scale-pulse-out-rapid">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    {!! HTML::script('plugins/owl/owl.carousel.min.js') !!}
    {!! HTML::script('plugins/baguettebox/baguetteBox.min.js') !!}
    {!! HTML::script('plugins/jquery-comments/jquery-comments.min.js') !!}
    {!! HTML::script('plugins/leaflet/leaflet.js') !!}
    <script>
        var lat = "{{ $initiative->latitude }}";
        var lng = "{{ $initiative->longitude }}";
        var title = "{{ htmlspecialchars($initiative->title) }}";
        var zoom = 10;
        markerImg = "{{ config('app.url') }}/images/marker.png";


        var points = new Array();
        var map = L.map('map').setView([lat, lng], zoom);
        mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapLink + ' Contributors',
            maxZoom: 18,
        }).addTo(map);

        marker = new L.marker([lat, lng], {})
        .bindPopup(title)
        .addTo(map);


        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                margin: 5,
                autoWidth:true,
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
                    //1024 : {
                    //    items: 4
                    //},
                    // breakpoint from 1200 up
                    //1200 : {
                    //    items: 5
                    //},
                    // breakpoint from 1400 up
                    //1400 : {
                    //    items: 6
                    //}
                }
            });
        });


        baguetteBox.run('.owl-carousel', {});


        $('.comments-container').comments({
            profilePictureURL: "{{ $userImg }}",
            spinnerIconURL: "{{ url('/') }}/images/loader.gif",
            textareaPlaceholderText: '{{ $commentAddPldr }}',
            sendText: '{{ $commentAddBtn }}',
            replyText: '{{ $commentReplyBtn }}',
            viewAllRepliesText: '{{ $commentViewRepliesBtn }}',
            hideRepliesText: '{{ $commentHideRepliesBtn }}',
            noCommentsText: '{{ $noCommentsMsg }}',
            enableEditing: false,
            enableUpvoting: false,
            enableDeleting: false,
            enableDeletingCommentWithReplies: false,
            enableNavigation: false,
            postCommentOnEnter: true,
            maxRepliesVisible: 10,
            fieldMappings: {
                id: 'id',
                parent: 'parent_id',
                created: 'created_at',
                modified: 'updated_at',
                content: 'body',
                fullname: 'user_fullname'
            },
            getComments: function(success, error) {
                $.ajax({
                    type: "get",
                    url: "{{ url('offer/comments') }}?init_id={{ $initiativeId }}",
                    success: function(commentsArray) {
                        success(commentsArray)
                    },
                    error: error
                });
            },
            postComment: function(commentJSON, success, error) {
                $.ajax({
                    type: "post",
                    url: "{{ url('offer/save/comment') }}?init_id={{ $initiativeId }}",
                    data: commentJSON,
                    success: function(comment) {
                        success(commentJSON)
                        $('#init-comments').html(comment.total_comments);
                        
                        $.post("{{ url('offer/ontomap/comment') }}", { 'initId': comment.initId, 'commentId': comment.commentId }, function(response){});
                    },
                    error: error
                });
            }
            <?php if(!Auth::check()) { ?>
            ,
            refresh: function() {
                $('div.commenting-field').remove();
            },
            enableReplying: false
            <?php } ?>
        });


        $(document).on("click", "#support-btn", function(e) {
            data = new Object();

            data['initiative_id'] = {{ $initiativeId }};
            

            var url = "{{ url('offer/save/supporter') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('#init-supporters').html(data.totalSupporters);

                    $.post("{{ url('offer/ontomap/supporter') }}", { 'initId': data.initId, 'userAction': data.userAction }, function(response){});
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });


        function confirmDelete() {
            if(confirm('{{ $deleteConfirmMsg }}')) {
                data = new Object();

                data['initiative_id'] = {{ $initiativeId }};
                

                var url = "{{ url('offer/delete/'.$initiative->id) }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        $('.loader-overlay').fadeIn(0);

                        $.post("{{ url('offer/delete/ontomap/'.$initiative->id) }}", {}, function(response){});

                        setTimeout(function() {
                            window.location.href = "{{ url('offers') }}";
                        }, 2500);
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {}
                });
            }
        }
    </script>
@endsection
