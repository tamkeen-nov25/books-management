<aside class="bg-light p-3" style="min-height: 400px;">
    <h5>{{ __('ui.sidebar') }}</h5>
    <ul class="list-unstyled">
        <li><a href="{{ route('home') }}">{{ __('ui.home') }}</a></li>
        <li><a href="{{ route('books.index') }}">{{ __('ui.book.book_list') }}</a></li>
        <li><a href="{{ route('books.create') }}">{{ __('ui.book.add_book') }}</a></li>
    </ul>
</aside>
