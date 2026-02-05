<!-- Language Switcher -->
<div class="dropdown">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-globe"></i> {{ __('ui.language') }}:
        <span class="badge bg-primary">
            {{ strtoupper(app()->getLocale()) }}
        </span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
        <li>
            <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ url('lang/en') }}">
                <i class="bi bi-flag-us"></i> {{ __('ui.english') }}
            </a>
        </li>
        <li>
            <a class="dropdown-item {{ app()->getLocale() === 'ar' ? 'active' : '' }}" href="{{ url('lang/ar') }}">
                <i class="bi bi-flag-sa"></i> {{ __('ui.arabic') }}
            </a>
        </li>
    </ul>
</div>
