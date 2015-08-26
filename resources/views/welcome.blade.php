<!doctype html> <html class=no-js> <head> <meta charset=utf-8> <meta id=csrf value="{{ csrf_token() }}"> <meta http-equiv=X-UA-Compatible content="IE=edge"> <meta name=viewport content="width=device-width, initial-scale=1"> <title>{{ Lang::get('copy.title') }}</title> <meta name=description content="Biscuit Profile Enhancement Suite, and other keywords for ancient SEO purposes">  <link rel=stylesheet href=styles/main.css> </head> <body ng-app=yapp> <!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->  <div> <div ui-view></div> </div>  <script>/*
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

     ga('create', 'UA-XXXXX-X');
     ga('send', 'pageview');
     */</script> <!--[if lt IE 9]>
<script src="scripts/oldieshim.js"></script>
<![endif]--> <script src=scripts/vendor.js></script> <script src=scripts/scripts.js></script> </body> </html>