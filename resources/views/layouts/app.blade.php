<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('images/kv.png') }}">
    <!-- FONTS -->
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css?family=Inter:100,200,300,400,400italic,500,600,700,700italic,900'>
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,400italic,500,600,700,700italic,900'>
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css?family=Muli:100,200,300,400,400italic,500,600,700,700italic,900'>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!--CSS -->
    <link rel='stylesheet' href='{{ asset('css/structure.css') }}'>
    <link rel='stylesheet' href='{{ asset('css/business3.css') }}'>
    <!-- Revolution Slider -->
    <link rel="stylesheet" href="{{ asset('rs-plugin-6.custom/css/rs6.css') }}">
</head>

<body
    class="home page template-slider style-simple button-default layout-full-width if-zoom if-border-hide header-transparent header-fw sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-right menuo-no-borders mobile-tb-center mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky">
    <div id="Wrapper">
        @include('layouts.nav')
        @yield('content')
        @include('layouts.footer')
    </div>
    <!-- JS -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.4.0.min.js') }}"></script>
    <script src="{{ asset('js/mfn.menu.js') }}"></script>
    <script src="{{ asset('js/jquery.plugins.js') }}"></script>
    <script src="{{ asset('js/jquery.jplayer.min.js') }}"></script>
    <script src="{{ asset('js/animations/animations.js') }}"></script>
    <script src="{{ asset('js/translate3d.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('rs-plugin-6.custom/js/revolution.tools.min.js') }}"></script>
    <script src="{{ asset('rs-plugin-6.custom/js/rs6.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     {{-- global alert --}}
     @if (session()->has('result'))
     <script>
         Swal.fire({
             title: '{{ session("title") }}',
             text: '{{ session("message") }}',
             icon: '{{ session("result") }}',
             toast: true,
             position: 'top',
             timer: 3000,
             showConfirmButton: false,
             customClass: {
                 popup: 'bg-white border shadow-sm',
                 title: 'text-dark mt-1 mb-2',
                 icon: 'fs-4 ms-1 mt-1 mb-0',
                 htmlContainer: 'text-muted fs-5 mt-0 mb-1',
                 confirmButton: 'bg-primary',
             }
         });
     </script>
     @endif
    <script>
        var revapi1, tpj;

        function revinit_revslider11() {
            jQuery(function() {
                tpj = jQuery;
                revapi1 = tpj("#rev_slider_1_1");
                if (revapi1 == undefined || revapi1.revolution == undefined) {
                    revslider_showDoubleJqueryError("rev_slider_1_1");
                } else {
                    revapi1.revolution({
                        sliderLayout: "fullwidth",
                        visibilityLevels: "1240,1240,778,778",
                        gridwidth: "1240,1240,778,778",
                        gridheight: "950,950,960,960",
                        spinner: "spinner9",
                        perspective: 600,
                        perspectiveType: "global",
                        spinnerclr: "#e6a94a",
                        editorheight: "950,768,960,720",
                        responsiveLevels: "1240,1240,778,778",
                        progressBar: {
                            disableProgressBar: true
                        },
                        navigation: {
                            onHoverStop: false
                        },
                        parallax: {
                            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 30],
                            type: "scroll",
                            origo: "slidercenter",
                            speed: 0
                        },
                        fallbacks: {
                            allowHTML5AutoPlayOnAndroid: true
                        },
                    });
                }
            });
        }
        var once_revslider11 = false;
        if (document.readyState === "loading") {
            document.addEventListener('readystatechange', function() {
                if ((document.readyState === "interactive" || document.readyState === "complete") && !
                    once_revslider11) {
                    once_revslider11 = true;
                    revinit_revslider11();
                }
            });
        } else {
            once_revslider11 = true;
            revinit_revslider11();
        }
    </script>
</body>

</html>
