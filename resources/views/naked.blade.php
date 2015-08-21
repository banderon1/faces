<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta id="csrf" value="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ Lang::get('copy.title') }}</title>

	<link href="/css/app.css" rel="stylesheet">


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
        <script src="/js/old-browser.js"></script>
	<![endif]-->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId   : '{{ Config::get('facebook_app_id') }}',
                xfbml   : true,
                version : 'v2.4'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</head>
@yield('body')
</html>
