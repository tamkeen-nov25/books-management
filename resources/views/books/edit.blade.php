@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('ui.book.edit_book') }}</h1>
    <form action="{{ route('books.update', $bookData->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('ui.book.title') }}</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $bookData->title }}" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">{{ __('ui.book.author') }}</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $bookData->author }}" required>
        </div>
        <div class="mb-3">
            <label for="published_year" class="form-label">{{ __('ui.book.published_year') }}</label>
            <input type="number" class="form-control" id="published_year" name="published_year" value="{{ $bookData->published_year }}" required>
        </div>
        <div class="mb-3">
            <label for="is_available" class="form-label">{{ __('ui.book.is_available') }}</label>
            <select class="form-control" id="is_available" name="is_available" required>
                <option value="1" {{ $bookData->is_available ? 'selected' : '' }}>{{ __('ui.yes') }}</option>
                <option value="0" {{ !$bookData->is_available ? 'selected' : '' }}>{{ __('ui.no') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="cover_color" class="form-label">{{ __('ui.book.cover_color') }}</label>
            <input type="text" class="form-control" id="cover_color" name="cover_color" value="{{ $bookData->cover->color ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="cover_format" class="form-label">{{ __('ui.book.cover_format') }}</label>
            <select class="form-control" id="cover_format" name="cover_format">
                <option value="">{{ __('ui.select_format') ?? 'Select Format' }}</option>
                <option value="1" {{ ($bookData->cover->format ?? '') == 1 ? 'selected' : '' }}>{{ __('ui.hardcover') }}</option>
                <option value="2" {{ ($bookData->cover->format ?? '') == 2 ? 'selected' : '' }}>{{ __('ui.paperback') }}</option>
                <option value="3" {{ ($bookData->cover->format ?? '') == 3 ? 'selected' : '' }}>{{ __('ui.ebook') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">{{ __('ui.book.categories') }}</label>
            <select class="form-control" id="categories" name="categories[]" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $bookData->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <x-button type="submit" class="btn btn-success">{{ __('ui.book.edit_book') }}</x-button>
    </form>
</div>
@endsection
