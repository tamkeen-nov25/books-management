@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('ui.book.book_list') }}</h1>
    <a href="{{ route('books.create') }}" class="btn btn-success mb-3">{{ __('ui.book.add_book') }}</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('ui.book.title') }}</th>
                <th>{{ __('ui.book.author') }}</th>
                <th>{{ __('ui.book.published_year') }}</th>
                <th>{{ __('ui.book.is_available') }}</th>
                <th>{{ __('ui.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->published_year }}</td>
                    <td>{{ $book->is_available ? __('ui.yes') : __('ui.no') }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">{{ __('ui.edit') }}</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('ui.messages.confirm_delete') }}')">{{ __('ui.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">{{ __('ui.no_results') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
