<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Vite Resources -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .full-height {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
        }

        .main-row {
            flex: 1;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            /* margin-top: 15px; */
            background: linear-gradient(135deg, #fceabb, #66a38a, #f6f1d3, #c6ffdd);
        }

        .main-body {
            flex: 1;
        }

        footer {
            background-color: #f1f1f1;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <div class="full-height">
        @include('layouts.navigation')

        <div class="main-row">
            <!-- Sidebar -->
            <div class="sidebar p-3">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <div class="main-body p-3">
                    @yield('content')
                </div>

                @include('layouts.footer')

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
