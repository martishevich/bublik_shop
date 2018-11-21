<!DOCTYPE html>
<html lang = "{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name = "csrf-token" content = "{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src = "{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel = "dns-prefetch" href = "https://fonts.gstatic.com">
        <link href = "https://fonts.googleapis.com/css?family=Nunito" rel = "stylesheet" type = "text/css">

        <!-- Styles -->
        <link href = "{{ asset('css/app.css') }}" rel = "stylesheet">
    </head>
    <body>
        <div id = "app">
            <nav class = "navbar navbar-expand-md navbar-light navbar-laravel">
                <div class = "container">
                    <a class = "navbar-brand" href = "{{ url('/') }}">
                        {{ 'Shop' }}
                    </a>
                    <!-- Authentication Links -->
                    @guest
                        <a class = "navbar-brand" href = "{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class = "navbar-brand" href = "{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <a class = "navbar-brand" href = "{{ route('logout') }}"
                           onclick = "event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <a class = "navbar-brand" href = "#">
                            {{ Auth::user()->name }}
                        </a>
                        <form id = "logout-form" action = "{{ route('logout') }}" method = "POST"
                              style = "display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </nav>

            <main class = "py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>
