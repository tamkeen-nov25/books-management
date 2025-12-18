@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $bookData->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $bookData->title }}" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $bookData->author }}" required>
        </div>
        <div class="mb-3">
            <label for="published_year" class="form-label">Published Year</label>
            <input type="number" class="form-control" id="published_year" name="published_year" value="{{ $bookData->published_year }}" required>
        </div>
        <div class="mb-3">
            <label for="is_available" class="form-label">Is Available</label>
            <select class="form-control" id="is_available" name="is_available" required>
                <option value="1" {{ $bookData->is_available ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$bookData->is_available ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <x-button type="submit" class="btn btn-success">Update Book</x-button>
    </form>
</div>
@endsection