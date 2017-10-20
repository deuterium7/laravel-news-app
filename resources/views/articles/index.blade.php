@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($articles as $article)
                <div class="clearfix">
                    <div class="col-md-4">
                        <a href="{{ route('articles.show', ['id' => $article->id]) }}" title="{{ $article->title }}">
                            <img src="{{ $article->image }}">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <h3 style="text-align: center">
                            <a href="{{ route('articles.show', ['id' => $article->id]) }}" title="{{ $article->title }}">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p style="text-align: justify">{{ mb_substr($article->body, 0, 300) . '...' }}</p>
                        <a href="{{ route('articles.show', ['id' => $article->id]) }}" title="{{ $article->title }}">
                            Читать далее
                        </a>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        <div style="text-align: center">{{ $articles->links() }}</div>
    </div>
@endsection
