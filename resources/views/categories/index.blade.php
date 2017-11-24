@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 category">
                    <a href="{{ route('categories.show', ['category' => $category]) }}" title="{{ $category->name }}">
                        <img src="{{ $category->image }}">
                    </a>
                    <a href="{{ route('categories.show', ['category' => $category]) }}" title="{{ $category->name }}" class="category-name">
                        {{ $category->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
