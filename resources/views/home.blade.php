@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('ui.welcome.welcome_to', ['app' => __('ui.app_name')]) }}</h1>
    <div class="row">
        <div class="col-md-6">
            <x-card :title="__('ui.books')">
                <p>{{ __('ui.welcome.manage_books') }}</p>
                <x-button href="{{ route('books.index') }}" class="btn btn-primary">{{ __('ui.welcome.go_to_books') }}</x-button>
            </x-card>
        </div>
        <div class="col-md-6">
            <x-card :title="__('ui.orders')">
                <p>{{ __('ui.welcome.manage_orders') }}</p>
            </x-card>
        </div>
    </div>
</div>
@endsection
