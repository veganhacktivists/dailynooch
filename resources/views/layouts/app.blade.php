<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="canonical" href="https://dailynooch.org/" />
	<meta name="description" content="Get your daily vegan news, memes, art, videos, inspiration, and more!" />

	<meta property="og:url" content="https://dailynooch.org/" />
	<meta property="og:title" content="Daily Nooch" />
	<meta property="og:description" content="Get your daily vegan news, memes, art, videos, inspiration, and more!" />
	<meta property="og:image" content="https://dailynooch.org/og-img.png" />
	<meta property="og:image:width" content="582" />
	<meta property="og:image:height" content="293" />
	<meta property="og:type" content="website" />
	<meta property="og:locale" content="en_US" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-9STKBLEQXX"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-9STKBLEQXX');
	</script>
	
	<!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="/favicon.png" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

    <title>@yield('title')</title>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-150398169-12"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-150398169-12');
	</script>
	
	<style>
	.fa-facebook-f {
		width: 39px !important;
		text-align: center !important;
	}
	.modal-container {
	border-radius: 11px !important;
	}
	</style>
	
	<style>
	 #bookmark-this {
	  padding: 7px 11px;
	  margin: 3px 3px;
	  background-color: #f0ad4e;
	  border: 1px solid #eea236;
	  border-radius: 4px;
	  font-size: 15px;
	  color: #fff;
	  text-decoration: none;
	  text-shadow: 0 -1px 0 rgba(0, 0, 0, .2);
	  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
	  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
	  -webkit-user-select:none;
	  -moz-user-select:none;
	  -ms-user-select:none;
	  user-select:none;
	}

	#bookmark-this:hover {
	  background-color: #ec971f;
	  border: 1px solid #d58512;
	  text-decoration: none;
	}

	#bookmark-this:active {
	  background-color: #ec971f;
	  border: 1px solid #d58512;
	  -webkit-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.2);
	  box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.2);
	}
	</style>
	
	<link rel="stylesheet" href="addtohomescreen.css">
	<script src="addtohomescreen.js"></script>

	<!-- Additionally, include jQuery (necessary for the bookmark script) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Scripts -->
    <script>
      window.__config = {!! json_encode(config('base')) !!}
    </script>
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,900" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @if (config('base.livewire'))
      @livewireStyles
      @livewireScripts
    @endif
  </head>
  <body>
    <div id="app" class="d-flex flex-column min-vh-100">
      @include('inc.navbar')

      <main class="py-4 flex-grow-1">
	  
	<div class="container">
    <div class="card mb-4 border-0">
	<div class="card-body">
	<blockquote class="blockquote" style="margin-bottom: -20px;">
	<p style="font-size: 15px;color: #5c5c5c;">😍&nbsp;Find the latest vegan news, recipes and more! Explore new vegan content every day by <a id="bookmark-this" href="#">bookmarking this page!</a></p>
    </blockquote>

    </div>
    </div>
    </div>
  
  
        @yield('content')
		<center><br><img src="https://dailynooch.org/favicon.png" style="width:20px;margin-top: -4px;">&nbsp;&nbsp;Daily Nooch was created with love by <a href="https://veganhacktivists.org" target="_blank">Vegan Hacktivists!</a><br><br><a href="https://veganhacktivists.org/contact" target="_blank">Contact us,</a> or support us <a href="https://www.patreon.com/veganhacktivists" target="_blank">on Patreon!</a>&nbsp;&nbsp;🐮&nbsp;💕</center>      </main>
	  <img src="https://i.imgur.com/LRAAzvY.png" style="width: 100%;">
    </div>
	
	<script>
		jQuery(function ($) {

	  $('#bookmark-this').click(function (e) {
		var bookmarkTitle = document.title;
		var bookmarkUrl = window.location.href;

		if ('addToHomescreen' in window && addToHomescreen.isCompatible) {
		  // Mobile browsers
		  addToHomescreen({ autostart: false, startDelay: 0 }).show(true);
		} else if (/CriOS\//.test(navigator.userAgent)) {
		  // Chrome for iOS
		  alert('To add to Home Screen, launch this website in Safari, then tap the Share button and select "Add to Home Screen".');
		} else if (window.sidebar && window.sidebar.addPanel) {
		  // Firefox <=22
		  window.sidebar.addPanel(bookmarkTitle, bookmarkUrl, '');
		} else if ((window.sidebar && /Firefox/i.test(navigator.userAgent) && !Object.fromEntries) || (window.opera && window.print)) {
		  // Firefox 23-62 and Opera <=14
		  $(this).attr({
			href: bookmarkUrl,
			title: bookmarkTitle,
			rel: 'sidebar'
		  }).off(e);
		  return true;
		} else if (window.external && ('AddFavorite' in window.external)) {
		  // IE Favorites
		  window.external.AddFavorite(bookmarkUrl, bookmarkTitle);
		} else {
		  // Other browsers (Chrome, Safari, Firefox 63+, Opera 15+)
		  alert('Press ' + (/Mac/i.test(navigator.platform) ? 'Cmd' : 'Ctrl') + '+D to bookmark this page.');
		}

		return false;
	  });

	});
	</script>
  </body>
</html>
