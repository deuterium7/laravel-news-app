@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="articles">
                @foreach($articles as $article)
                    <div class="article">
                        <div class="clearfix">
                            <div class="col-md-4">
                                <a href="{{ route('articles.show', ['article' => $article->id]) }}" title="{{ $article->title }}">
                                    <img src="{{ $article->image }}">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <h3 class="center">
                                    <a href="{{ route('articles.show', ['article' => $article->id]) }}" title="{{ $article->title }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p>{{ mb_substr($article->body, 0, 300) . '...' }}</p>
                                <div style="float:left;">
                                    <a href="{{ route('articles.show', ['article' => $article->id]) }}" title="{{ $article->title }}">
                                        @lang('catalog.read')
                                    </a>
                                </div>
                                <div style="float:right;">
                                    @if($article->updated_at <= $article->created_at)
                                        <span>@lang('catalog.createdAt'): {{ $article->created_at->diffForHumans() }}</span>
                                    @else
                                        <span>@lang('catalog.updatedAt'): {{ $article->updated_at->diffForHumans() }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="links">{{ $articles->links() }}</div>
    </div>
@endsection
