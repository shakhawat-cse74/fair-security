<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    @include('backend.partial.meta')

    <!-- TITLE -->
    <title>{{ $systemSettings?->site_name ?? 'Fire-Security' }} - @yield('title')</title>

    @stack('styles')
    @include('backend.partial.style')

    <style>
        /* ===== Layout Fix for Sticky Footer ===== */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Poppins', sans-serif;
        }

        .page {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .page-main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .app-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        footer.footer {
            margin-top: auto; 
        }

        /* Optional: Prevent loader from covering footer positioning */
        #global-loader {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(255,255,255,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
    </style>
</head>

<body class="ltr app sidebar-mini">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('admin/assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            {{-- HEADER --}}
            @include('backend.partial.header')

            {{-- SIDEBAR --}}
            @include('backend.partial.sidebar')

            {{-- MAIN CONTENT --}}
            <div class="app-content main-content mt-0">
                <div class="side-app">
                    <div class="main-container container-fluid">
                        @yield('body')
                    </div>
                </div>
            </div>

        </div>

        {{-- FOOTER --}}
        @include('backend.partial.footer')
    </div>

    {{-- SCRIPTS --}}
    @include('backend.partial.script')
    @stack('scripts')

</body>
</html>
