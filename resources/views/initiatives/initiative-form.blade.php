@extends('layouts.app')

@section('csslibs')
    {!! HTML::style('plugins/dropzone/dropzone.css') !!}
    {!! HTML::style('plugins/datepicker/datepicker.min.css') !!}
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h1 class="h4">{{ $initiativeFormHeading1 }}</h1>
                </div>
            </div>


            <div class="initiative-form">
                {!! Form::open(['id' => 'initiative-form']) !!}
                    <div class="row">
                        <div class="col xl6">
                            <div class="row">
                                <div class="input-field col s12">
                                    {!! Form::label('initiative_type', $typeLbl.' *', ['class' => 'active']) !!}
                                    <select id="initiative_type">
                                        <option value="" disabled selected>{{ $typePldr }}</option>
                                        @foreach($initiativeTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-field col s12">
                                    {!! Form::text('title', '', ['id' => 'title', 'class' => '', 'placeholder' => $titlePldr, 'maxlength' => '255']) !!}
                                    {!! Form::label('title', $titleLbl, ['class' => 'active']) !!}
                                </div>

                                <div class="input-field col s12 l6">
                                    {!! Form::text('start_date', '', ['id' => 'start-date', 'class' => 'datepicker-here', 'placeholder' => $startDatePldr]) !!}
                                    {!! Form::label('start-date', $startDateLbl, ['class' => 'active']) !!}
                                </div>

                                 <div class="input-field col s12 l6">
                                    {!! Form::text('end_date', '', ['id' => 'end-date', 'class' => 'datepicker-here', 'placeholder' => $endDatePldr]) !!}
                                    {!! Form::label('end-date', $endDateLbl, ['class' => 'active']) !!}
                                </div>

                                <div class="input-field col s12">
                                    {!! Form::textarea('description', '', ['id' => 'description', 'class' => 'materialize-textarea', 'placeholder' => $descriptionPldr]) !!}
                                    {!! Form::label('description', $descriptionLbl, ['class' => 'active']) !!}
                                </div>
                            </div>
                        </div>

   
                        <div class="col s12 xl6">
                            <iframe class="input-map" title="input a location" src="https://inputmap.firstlife.org?domain={{ config('app.url') }}&mode=lite"></iframe>
                            
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


                        <div class="col s12">
                            <div class="dropzone-wrapper">
                                <div id="init-dropzone" class="dropzone">
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
                            {{--  {!! Form::button($cancelBtn, array('id' => 'cancel-btn', 'class' => 'waves-effect waves-light btn-flat')) !!}  --}}
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

                        {{-- <div class="dz-details">
                            <div class="dz-size"><span data-dz-size=""></span></div>
                            <div class="dz-filename"><span data-dz-name=""></span></div>
                        </div> --}}

                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                        <div class="dz-error-message"><span data-dz-errormessage=""></span></div>

                        {{-- <div class="dz-success-mark">
                            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                                <title>Check</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                    <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                </g>
                            </svg>
                        </div>

                        <div class="dz-error-mark">
                            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                                <title>error</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                    <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                        <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                    </g>
                                </g>
                            </svg>
                        </div> --}}
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
    {!! HTML::script('plugins/datepicker/datepicker.min.js') !!}
    {!! HTML::script('plugins/datepicker/i18n/datepicker.en.js') !!}
    {!! HTML::script('plugins/dropzone/dropzone.min.js') !!}

    <script>
        Dropzone.autoDiscover = false;

        var imgDropzone = new Dropzone("#init-dropzone", {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('offer/image/upload') }}",
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


        // Datetime pickers
        var $startDatepicker = $('#start-date').datepicker({
            language: "en",
            dateFormat: "dd-mm-yyyy",
            timepicker: true,
            timeFormat: "h:ii",
            minutesStep: 5,
            minDate: new Date(),
            onSelect: function(formattedDate, date, inst) {
                $endDatepicker.data('datepicker').update('minDate', date);
            }
        });

        var $endDatepicker = $('#end-date').datepicker({
            language: "en",
            dateFormat: "dd-mm-yyyy",
            timepicker: true,
            timeFormat: "h:ii",
            minutesStep: 5,
            minDate: new Date(),
            onSelect: function(formattedDate, date, inst) {
                $startDatepicker.data('datepicker').update('maxDate', date);
            }
        });

        $(document).ready(function() {
            $('select').material_select();
        });


        // InputMap
        var iframeDomain = "{{ config('app.url') }}";

        window.addEventListener("message",
            function(e) {
                if(e.defaultPrevented)
                    return
                e.preventDefault();

                //if(e.origin !== iframeDomain) {
                //    return;
                //}

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

            data['initiative_type'] = $('#initiative_type').val();
            data['title'] = $('#title').val();
            data['start_date'] = $('#start-date').val();
            data['end_date'] = $('#end-date').val();
            data['date'] = $('#date').val();
            data['description'] = $('#description').val();
            data['latitude'] = $('#lat').text();
            data['longitude'] = $('#lon').text();
            data['address'] = $('#display-name').text();
            data['input_map_data'] = "{'areaId':'"+$('#id').text()+"','areaName':'"+$('#name').text()+"','osmId':'"+$('#osmid').text()+"','type':'"+$('#type').text()+"','zoom':'"+$('#zoom').text()+"','src':'"+$('#src').text()+"','tileId':'"+$('#tileid').text()+"','tile':'"+$('#tile').text()+"','address':'"+$('#address').text()+"'}";
            
            var url = "{{ url('offer/save') }}";

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
                            $('#initiative-form').fadeOut(0);

                            imgDropzone.options.params = { 'initId': data.initId };
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
                                $.post("{{ url('offer/save/ontomap') }}", { 'initId': data.initId, 'images': imagesArray }, function(response){});
                            });


                            // If there are no images, post to OTM directly
                            if(!hasFiles) {
                                $.post("{{ url('offer/save/ontomap') }}", { 'initId': data.initId, 'images': imagesArray }, function(response){});
                            }

                            $('#response').text(data.message).removeClass('hide');
                            $('.loader-overlay').fadeOut(0);
                        }, 2500);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });
    </script>
@endsection
