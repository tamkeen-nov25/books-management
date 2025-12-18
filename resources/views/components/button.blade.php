@props(['type' => 'button', 'class' => 'btn btn-primary', 'href' => null])

@if($href)
    <a href="{{ $href }}" class="{{ $class }}">
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="{{ $class }}">
        {{ $slot }}
    </button>
@endif