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

      <div class="container greeting-message">
        <div class="card mb-4 border-0">
          <div class="card-body">
            <blockquote class="blockquote">
              <span>
                😍&nbsp;Find the latest vegan news, recipes and more! Explore new vegan content every day by <a id="bookmark-this" class="btn btn-secondary mt-n1 px-2 py-1" href="#">bookmarking this page!</a>
              </span>
            </blockquote>
          </div>
        </div>
      </div>

      @yield('content')

      <footer>
        <center><br><img src="https://dailynooch.org/favicon.png" style="width:20px;margin-top: -4px;">&nbsp;&nbsp;Daily Nooch was created with love by <a href="https://veganhacktivists.org" target="_blank">Vegan Hacktivists!</a><br><br><a href="https://veganhacktivists.org/contact" target="_blank">Contact us,</a> or support us <a href="https://www.patreon.com/veganhacktivists" target="_blank">on Patreon!</a>&nbsp;&nbsp;🐮&nbsp;💕</center>      </main>
        <img src="https://i.imgur.com/LRAAzvY.png" style="width: 100%;">
      </footer>
    </div>
  </body>
</html>
