<div class="{{ $class }}">
    <div class="card-body">
        @if($title)
            <h5 class="card-title">{{ $title }}</h5>
        @endif
        {{ $slot }}
    </div>
</div>