@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('ui.book.create_book') }}</h1>
    </div>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('ui.book.title') }}</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">{{ __('ui.book.author') }}</label>
            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" required value="{{ old('author') }}">
            @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="published_year" class="form-label">{{ __('ui.book.published_year') }}</label>
            <input type="number" class="form-control @error('published_year') is-invalid @enderror" id="published_year" name="published_year" required value="{{ old('published_year') }}">
            @error('published_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">{{ __('ui.book.description') }}</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="is_available" class="form-label">{{ __('ui.book.is_available') }}</label>
            <select class="form-control @error('is_available') is-invalid @enderror" id="is_available" name="is_available" required>
                <option value="">{{ __('ui.loading') }}</option>
                <option value="1" {{ old('is_available') == 1 ? 'selected' : '' }}>{{ __('ui.yes') }}</option>
                <option value="0" {{ old('is_available') == 0 ? 'selected' : '' }}>{{ __('ui.no') }}</option>
            </select>
            @error('is_available')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover_color" class="form-label">{{ __('ui.book.cover_color') }}</label>
            <input type="text" class="form-control @error('cover_color') is-invalid @enderror" id="cover_color" name="cover_color" value="{{ old('cover_color') }}">
            @error('cover_color')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover_format" class="form-label">{{ __('ui.book.cover_format') }}</label>
            <select class="form-control @error('cover_format') is-invalid @enderror" id="cover_format" name="cover_format">
                <option value="">{{ __('ui.loading') }}</option>
                <option value="1" {{ old('cover_format') == 1 ? 'selected' : '' }}>{{ __('ui.hardcover') }}</option>
                <option value="2" {{ old('cover_format') == 2 ? 'selected' : '' }}>{{ __('ui.paperback') }}</option>
                <option value="3" {{ old('cover_format') == 3 ? 'selected' : '' }}>{{ __('ui.ebook') }}</option>
            </select>
            @error('cover_format')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">{{ __('ui.book.categories') }}</label>
            <select class="form-control @error('categories') is-invalid @enderror" id="categories" name="categories[]" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('categories')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">{{ __('ui.book.create_book') }}</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">{{ __('ui.back') }}</a>
        </div>
    </form>
</div>
@endsection
