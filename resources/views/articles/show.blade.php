@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4"><img src="{{ $article->image }}"></div>
            <div class="col-md-8">
                <h2 style="text-align: center">{{ $article->title }}</h2>
                <h4>Автор статьи: {{ $author }}</h4>
                <p style="text-align: justify">{{ $article->body }}</p>
                @if($article->created_at)
                    <div class="col-md-6">Дата создания: {{ $article->created_at }}</div>
                    @if($article->created_at != $article->updated_at)
                        <div class="col-md-6">Дата обновления: {{ $article->updated_at }}</div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
