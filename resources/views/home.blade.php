@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to Books Management</h1>
    <div class="row">
        <div class="col-md-6">
            <x-card title="Books">
                <p>Manage your book collection.</p>
                <x-button href="{{ route('books.index') }}" class="btn btn-primary">Go to Books List</x-button>
            </x-card>
        </div>
        <div class="col-md-6">
            <x-card title="Orders">
                <p>View and manage orders.</p>
            </x-card>
        </div>
    </div>
</div>
@endsection