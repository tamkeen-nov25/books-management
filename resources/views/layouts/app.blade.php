<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('ui.app_name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">



    @include('partials.header')

    <!-- Content -->
    <div class="container-fluid flex-grow-1">
        <div class="row h-100">

            <!-- Sidebar -->
            <div class="col-md-3 d-flex">
                <aside class="w-100 vh-100 bg-light pt-4">
                    @include('partials.sidebar')
                </aside>
            </div>

            <!-- Main content -->
            <div class="col-md-9">
                <main class="mt-4">
                    @yield('content')
                </main>
            </div>

        </div>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
