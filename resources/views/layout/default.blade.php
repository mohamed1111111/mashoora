{{--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
 --}}
<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>
    <head>
        <meta charset="utf-8"/>

        {{-- Title Section --}}
        <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

        {{-- Meta Data --}}
        <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />
            <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('media/logos/faviconn.ico') }}/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('media/logos/faviconnn.ico') }}/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('media/logos/faviconnn.ico') }}/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('media/logos/faviconn.ico') }}/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('media/logos/faviconn.ico') }}/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('media/logos/faviconn.ico') }}/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('media/logos/faviconn.ico') }}/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('media/logos/faviconn.ico') }}/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/logos/faviconn.ico') }}/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('media/logos/faviconn.ico') }}/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('media/logos/faviconn.ico') }}/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('media/logos/faviconn.ico') }}/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('media/logos/faviconn.ico') }}/favicon-16x16.png">
<link rel="manifest" href="{{ asset('media/logos/faviconn.ico') }}/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{ asset('media/logos/faviconn.ico') }}/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

        {{-- Fonts --}}
        {{ Metronic::getGoogleFontsInclude() }}

        {{-- Global Theme Styles (used by all pages) --}}
        @foreach(config('layout.resources.css') as $style)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach

        {{-- layout Themes (used by all pages) --}}
        @foreach (Metronic::initThemes() as $theme)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
        @endforeach
        {{-- Includable Javascript --}}

        @yield('select2')
        @yield('js')

        {{-- Includable CSS --}}
        @yield('styles')
    </head>

    <body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }} >

        @if (config('layout.page-loader.type') != '')
            @include('layout.partials._page-loader')
        @endif

        @include('layout.base._layout')

        <script>var HOST_URL = "{{ route('quick-search') }}";</script>

        {{-- Global Config (global config for global JS scripts) --}}
        <script>
        $(document).ready(function() {
          $('div.dataTables_filter input').addClass('form-control');

        });
        </script>

        <script>
            var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};


        </script>

        {{-- Global Theme JS Bundle (used by all pages)  --}}
        @foreach(config('layout.resources.js') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach

        {{-- Includable JS --}}
        @yield('scripts')

    </body>
</html>
