@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Book</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="mb-3">
            <label for="published_year" class="form-label">Published Year</label>
            <input type="number" class="form-control" id="published_year" name="published_year" required>
        </div>
        <div class="mb-3">
            <label for="is_available" class="form-label">Is Available</label>
            <select class="form-control" id="is_available" name="is_available" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="cover_color" class="form-label">Cover Color</label>
            <input type="text" class="form-control" id="cover_color" name="cover_color">
        </div>
        <div class="mb-3">
            <label for="cover_format" class="form-label">Cover Format</label>
            <select class="form-control" id="cover_format" name="cover_format">
                <option value="">Select Format</option>
                <option value="1">Hardcover</option>
                <option value="2">Paperback</option>
                <option value="3">Ebook</option>
            </select>

        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Categories</label>
            <select class="form-control" id="categories" name="categories[]" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <x-button type="submit" class="btn btn-success">Create Book</x-button>
    </form>
</div>
@endsection