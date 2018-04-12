<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="{{ $metaDescription }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $pageTitle }}</title>

        {!! HTML::style('css/app.css') !!}
        @yield('csslibs')
    </head>

    <body>
        @section('header')
            @include('partials.header')
        @show

        @yield('content')

        {!! HTML::script('js/app.js') !!}
        <script>
            // Automatically add the token to all AJAX request headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // CORS XMLHttpRequest
            // Check whether a user is currently logged into WeGovNow without actually
            // forcing the user's web browser to perform a login if no user was logged in.
            function checkWeGovNowSession(callback) {
                var xhr = new XMLHttpRequest();
                var url = "{{ env('UWUM_SESSION_URL') }}";
                xhr.open("POST", url, true);
                xhr.withCredentials = true; // sends UWUM cookies to UWUM (important)
                xhr.onreadystatechange = function() {
                    if(xhr.readyState == 4) {
                        if(xhr.status == 200) {
                            var r = JSON.parse(xhr.responseText);
                            console.log(r);
                            callback(r.member_id);
                        } else {
                            // some error occured, add error handling
                            callback(undefined);
                        }
                    }
                }
                xhr.send();
            }

            function setUwumState(isLoggedIn, userId) {
                data = new Object();
                data['is_logged_in'] = isLoggedIn;
                data['user_id'] = userId;

                var url = "{{ url('uwum/check-user') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        if(data.action === 'logout') {
                            window.location.reload();
                        }
                        if(data.action === 'login') {
                            window.location = "{{ url('login/uwum') }}";
                        }

                        console.log(data);
                    },
                    errors: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log('UWUM error - Cannot login/logout automatically');
                        console.log(XMLHttpRequest.status + ' - ' + textStatus + ' - ' + errorThrown);
                    }
                });
            }

            jQuery(document).ready(function($) {
                checkWeGovNowSession(function(result) {
                    if (result === undefined) { // note === to distinguish undefined from null
                        console.log("UWUM: Error during request")
                        setUwumState(false, 0);
                    } else if (result) {
                        console.log("UWUM: Web browser claims that a user with the following ID is logged in: " + result);
                        setUwumState(true, result);
                    } else {
                        console.log("UWUM: Web browser claims that no user is logged in.");
                        setUwumState(false, 0);
                    }
                });
            });
        </script>

        @yield('jslibs')
    </body>
</html>
