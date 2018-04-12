@extends('layouts.app')

@section('csslibs')
    {!! HTML::style('plugins/dropzone/dropzone.css') !!}
    {!! HTML::style('plugins/owl/assets/owl.carousel.min.css') !!}
    {!! HTML::style('plugins/owl/assets/owl.theme.green.min.css') !!}
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h1 class="h4">{{ $associationFormHeading1 }}</h1>
                </div>
            </div>


            <div class="association-form">
                {!! Form::open(['id' => 'association-form']) !!}
                    <div class="row">
                        <div class="col xl6">
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::text('title', $title, ['id' => 'title', 'class' => '', 'placeholder' => $titlePldr, 'maxlength' => '255']) !!}
                                    {!! Form::label('title', $titleLbl, ['class' => 'active']) !!}
                                </div>

                                <div class="input-field col s12">
                                    {!! Form::text('phone', $phone, ['id' => 'phone', 'class' => '', 'placeholder' => $phonePldr, 'maxlength' => '20']) !!}
                                    {!! Form::label('phone', $phoneLbl, ['class' => 'active']) !!}
                                </div>

                                <div class="input-field col s12">
                                    {!! Form::text('phone_2', $phone2, ['id' => 'phone_2', 'class' => '', 'placeholder' => $phone2Pldr, 'maxlength' => '20']) !!}
                                    {!! Form::label('phone_2', $phone2Lbl, ['class' => 'active']) !!}
                                </div>

                                <div class="input-field col s12">
                                    {!! Form::email('email', $email, ['id' => 'email', 'class' => '', 'placeholder' => $emailPldr, 'maxlength' => '255']) !!}
                                    {!! Form::label('email', $emailLbl, ['class' => 'active']) !!}
                                </div>

                                <div class="input-field col s12">
                                    {!! Form::text('website', $website, ['id' => 'website', 'class' => '', 'placeholder' => $websitePldr, 'maxlength' => '70']) !!}
                                    {!! Form::label('website', $websiteLbl, ['class' => 'active']) !!}
                                </div>

                                <div class="input-field col s12">
                                    {!! Form::textarea('description', $description, ['id' => 'description', 'class' => 'materialize-textarea', 'placeholder' => $descriptionPldr, 'data-length' => 1000]) !!}
                                    {!! Form::label('description', $descriptionLbl, ['class' => 'active']) !!}
                                </div>
                            </div>
                        </div>

   
                        <div class="col s12 xl6">
                            <iframe class="input-map" title="input a location" src="{{ env('INPUTMAP_URL') }}?domain={{ config('app.url') }}&mode=lite @if('update' == $mode)&lat={{ $latitude }}&lon={{ $longitude }}&zoom=14&state=edit @endif"></iframe>
                            
                            <div class="helper">
                                <h2 class="h6"><u>Area Info</u></h2>
                                <ul>
                                    <li><b>Name:</b> <span id="name"></span></li>
                                    <li><b>Area Id:</b> <span id="id"></span></li>
                                    <li><b>OSM Id:</b> <span id="osmid"></span></li>
                                    <li><b>Type:</b> <span id="type"></span></li>
                                </ul>

                                <h3 class="h6"><u>Area Info</u></h3>
                                <ul>
                                    <li><b>Latitude:</b> <span id="lat"></span></li>
                                    <li><b>Longitude:</b> <span id="lon"></span></li>
                                    <li><b>Zoom:</b> <span id="zoom"></span></li>
                                </ul>
                                
                                <h4 class="h6"><u>InputMap Info</u></h4>
                                <ul>
                                    <li><b>Src:</b> <span id="src"></span></li>
                                    <li><b>Tileid:</b> <span id="tileid"></span></li>
                                    <li><b>Tile:</b> <span id="tile"></span></li>
                                </ul>

                                <h4 class="h6"><u>Address</u></h4>
                                <ul>
                                    <li><b>Display Name:</b> <span id="display-name"></span></li>
                                    <li><b>Address:</b> <span id="address"></span></li>
                                </ul>
                            </div>
                        </div>


                        <div class="initiative-images col s12">
                            @if(!empty($association->images))
                            <div class="owl-carousel owl-theme">
                                @foreach ($association->images as $image)
                                <div class="item carousel-item">
                                    {!! HTML::image('storage/associations/'.$image->name, $association->title, array('class' => '')) !!}
                                    {!! Form::button('<i class="large material-icons">delete</i>', array('data-img-id' => $image->id, 'class' => 'waves-effect waves-light btn-floating remove-img')) !!}
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>


                        <div class="col s12">
                            <div class="dropzone-wrapper">
                                <div id="assoc-dropzone" class="dropzone">
                                    <div class="dz-message">
                                        <h6 class="h5">Drop images in this area</h6>
                                        <i class="material-icons">file_upload</i>
                                    </div>

                                    <div class="fallback">
                                        <input name="files" type="file" multiple />
                                    </div>

                                    <div class="dropzone-previews" id="dropzonePreview"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col s12">
                            {!! Form::button($saveBtn, array('id' => 'save-btn', 'class' => 'waves-effect waves-light btn')) !!}
                        </div>
                    </div>
                {!! Form::close() !!}


                <div class="row">
                    <div class="col s12">
                        <p id="response" class="hide"></p>
                    </div>
                </div>


                <!-- Dropzone Preview Template -->
                <div id="preview-template" style="display: none;">
                    <div class="dz-preview dz-file-preview card">
                        <div class="dz-image"><img data-dz-thumbnail=""></div>

                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                        <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                    </div>
                </div>
                <!-- End Dropzone Preview Template -->
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
    {!! HTML::script('plugins/dropzone/dropzone.min.js') !!}
    {!! HTML::script('plugins/owl/owl.carousel.min.js') !!}

    <script>
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
                    },
                    // breakpoint from 1024 up
                    1024 : {
                        items: 4
                    },
                    // breakpoint from 1200 up
                    1200 : {
                        items: 5
                    },
                    // breakpoint from 1400 up
                    1400 : {
                        items: 6
                    }
                }
            });
        });



        Dropzone.autoDiscover = false;

        var imgDropzone = new Dropzone("#assoc-dropzone", {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('association/image/upload') }}",
            paramName: "files",
            uploadMultiple: true,
            maxFiles: 10,
            parallelUploads: 2,
            filesizeBase: 1024,
            maxFilesize: {{ env('MAX_FILE_SIZE') }},
            acceptedFiles: 'image/*',
            previewsContainer: '#dropzonePreview',
            previewTemplate: document.querySelector('#preview-template').innerHTML,
            addRemoveLinks: true,
            dictRemoveFile: '{{ $removeImageBtn }}',
            dictFileTooBig: '{{ $imageUploadFileSizeMsg }}',
            dictResponseError: '{{ $imageUploadErrorMsg }}',
            dictInvalidFileType: '{{ $imageUploadFileTypeMsg }}',
            dictMaxFilesExceeded: '{{ $imageUploadFileNumberMsg }}',
            autoProcessQueue: false,
            
            error: function(file, response) {
                if($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = response.message;

                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];

                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }

                return _results;
            },
            successmultiple: function(file, response) {}
        });



        // InputMap
        var iframeDomain = "{{ config('app.url') }}";

        window.addEventListener("message",
            function(e) {
                if(e.defaultPrevented)
                    return
                e.preventDefault();

                // if(e.origin !== iframeDomain) {
                //     return;
                // }

                if(e.data.src == 'InputMap')
                    setInputMapData(e.data);
        });

        function setInputMapData(data) {
            console.log('got message', data);
            document.getElementById("lat").innerHTML = data.lat;
            document.getElementById("lon").innerHTML = data.lng;
            document.getElementById("zoom").innerHTML = data.zoom_level;
            document.getElementById("id").innerHTML = data.id;
            document.getElementById("name").innerHTML = data.name;
            document.getElementById("src").innerHTML = data.src;
            document.getElementById("osmid").innerHTML = data.osm_id;
            document.getElementById("type").innerHTML = data.type;
            document.getElementById("tile").innerHTML = JSON.stringify(data.tile);
            document.getElementById("tileid").innerHTML = data.tileid;
            document.getElementById("display-name").innerHTML = data.display_name ? data.display_name : 'undefined';
            document.getElementById("address").innerHTML = data.address ? JSON.stringify(data.address) : 'undefined';
        }



        // PC form fields keypress
        $(document).on("keypress", "#title", function(e) {
            if(e.which == 13) {
                $('#save-btn').click();
                e.preventDefault();
            }
        });

        $(document).on("click", "#save-btn", function(e) {
            data = new Object();
            var imagesArray = new Array();
            var hasFiles = false;

            data['title'] = $('#title').val();
            data['phone'] = $('#phone').val();
            data['phone_2'] = $('#phone_2').val();
            data['email'] = $('#email').val();
            data['website'] = $('#website').val();
            data['description'] = $('#description').val();
            data['latitude'] = $('#lat').text();
            data['longitude'] = $('#lon').text();
            data['address'] = $('#display-name').text();
            data['input_map_data'] = "{'areaId':'"+$('#id').text()+"','areaName':'"+$('#name').text()+"','osmId':'"+$('#osmid').text()+"','type':'"+$('#type').text()+"','zoom':'"+$('#zoom').text()+"','src':'"+$('#src').text()+"','tileId':'"+$('#tileid').text()+"','tile':'"+$('#tile').text()+"','address':'"+$('#address').text()+"'}";
            
            var url = "{{ url('association/save') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    if((data.errors)) {
                        var errorCount = 0;

                        $.each(data.errors, function(key, value) {
                            if(0 == errorCount) {
                                Materialize.toast(value, 5000, 'red darken-1')
                            }

                            errorCount++;
                        })
                    }
                    else {
                        $('.loader-overlay').fadeIn(0);
                        

                        setTimeout(function() {
                            $('#association-form').fadeOut(0);

                            imgDropzone.options.params = { 'assocId': data.assocId };
                            imgDropzone.processQueue();

                            // Check if there are images
                            if(imgDropzone.getUploadingFiles().length > 0) {
                                hasFiles = true;
                            }

                            imgDropzone.on("success", function() {
                                imgDropzone.options.autoProcessQueue = true;
                            });

                            imgDropzone.on("successmultiple", function(file, response) {
                                $.each(response.files, function(key, value) {
                                    imagesArray.push(value);
                                });
                            });

                            imgDropzone.on("queuecomplete", function() {
                                imgDropzone.options.autoProcessQueue = false;

                                // If there are images, post to OTM after dropzone uploading is completed
                                //$.post("{{ url('offer/save/ontomap') }}", { 'assocId': data.assocId, 'images': imagesArray }, function(response){});
                            });


                            // If there are no images, post to OTM directly
                            /*if(!hasFiles) {
                                $.post("{{ url('offer/save/ontomap') }}", { 'assocId': data.assocId, 'images': imagesArray }, function(response){});
                            }*/

                            $('#response').text(data.message).removeClass('hide');
                            $('.loader-overlay').fadeOut(0);
                        }, 2500);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });


        @if('update' == $mode)
        $(document).on("click", ".remove-img", function(e) {
            data = new Object();

            data['init_id'] = '{{ $association->id }}';
            data['image_id'] = $(this).attr('data-img-id');
            

            var url = "{{ url('association/image/remove') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    var totalItems = $('.item').length;

                    for(var i=0; i<totalItems; i++) {
                        $(".owl-carousel").trigger('remove.owl.carousel', [i]);
                    }

                    var newItems = data.initImages;

                    for(i=0; i<newItems.length; i++) {
                        $('.owl-carousel').trigger('add.owl.carousel', ['<div class="item carousel-item"><img src="{{ env("APP_URL") }}/storage/associations/' + newItems[i]['name'] + '" alt=""> <button data-img-id="' + newItems[i]['id'] + '" class="waves-effect waves-light btn-floating remove-img" type="button"><i class="large material-icons">delete</i></button></div>']);
                    }

                    $('.owl-carousel').trigger('refresh.owl.carousel');
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });
        @endif
    </script>
@endsection
