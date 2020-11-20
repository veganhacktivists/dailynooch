<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-150398169-12"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-150398169-12');
	</script>
	
	<SCRIPT LANGUAGE="JavaScript">

	<!-- Begin

	function bookmark()

	{

	bookmarkurl="https://www.example.com";// replace your site URL

	bookmarktitle="example.com: PHP SQL and Javascript Source"; // replace this line with your site title

	if (document.all)

	window.external.AddFavorite(bookmarkurl,bookmarktitle)

	else if (window.sidebar) // firefox

		window.sidebar.addPanel(bookmarktitle, bookmarkurl, "");

	}

	// End -->

	</script>

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
    <div id="app">
      @include('inc.navbar')

      <main class="py-4">
	  
	<div class="container">
    <div class="card mb-4 border-0">
	<div class="card-body">
	<blockquote class="blockquote" style="margin-bottom: -20px;">
	<p style="font-size: 15px;color: #5c5c5c;">😍&nbsp;Find the latest vegan news, recipes and more! Please <a href="javascript:bookmark()">bookmark this page</a> for new content everyday!</p>
    </blockquote>
    </div>
    </div>
    </div>
  
  
        @yield('content')
		<center><br>Daily Nooch was created with love by <a href="https://veganhacktivists.org" target="_blank">Vegan Hacktivists!</a><br><br><a href="https://veganhacktivists.org/contact" target="_blank">Contact us,</a> or support us <a href="https://www.patreon.com/veganhacktivists" target="">on Patreon!</a>&nbsp;&nbsp;🐮&nbsp;💕</center>      </main>
	  <img src="https://i.imgur.com/0ACWn9B.png" style="width: 100%;">
    </div>
  </body>
</html>
