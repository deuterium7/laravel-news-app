@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <ul class="categories">
                @foreach($categories as $category)
                    <li class="category" style="background-color: red; color: white;">
                        <a href="{{ route('categories.show', ['category' => $category]) }}" title="{{ $category->name }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
