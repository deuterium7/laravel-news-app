@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4" style="margin-bottom: 16px; text-align: center">
                    <a href="{{ route('categories.show', ['category' => $category]) }}" title="{{ $category->name }}">
                        <img src="{{ $category->image }}">
                    </a>
                    <a href="{{ route('categories.show', ['category' => $category]) }}" title="{{ $category->name }}" style="display:block; margin-top: 4px;">
                        {{ $category->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
