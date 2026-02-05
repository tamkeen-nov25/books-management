<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">{{ __('ui.app_name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('ui.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">{{ __('ui.books') }}</a>
                    </li>
                </ul>
            </div>

                <div class="w-100 bg-transparent py-2">
        <div class="container d-flex justify-content-end">
            <x-language-switcher />
        </div>
    </div>
        </div>
    </nav>
</header>
