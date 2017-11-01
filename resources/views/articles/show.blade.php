@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="news-single" style="background-color: red; color: white;">
                <div class="clearfix">
                    <div class="col-md-4"><img src="{{ $article->image }}"></div>
                    <div class="col-md-8">
                        <h2>{{ $article->title }}</h2>
                        <h4>Категория:
                            <a href="#" title="{{ $category }}">
                                {{ $category }}
                            </a>
                        </h4>
                        <h4>Автор статьи:
                            <a href="#" title="{{ $author }}">
                                {{ $author }}
                            </a>
                        </h4>
                        <p style="text-align: justify">{{ $article->body }}</p>
                        <div class="col-md-6">Дата создания: {{ $article->created_at }}</div>
                        <div class="col-md-6">Дата обновления: {{ $article->updated_at }}</div>
                    </div>
                </div>
            </div>
            <div class="comments" style="background-color: green; color: white;">
                @foreach($comments as $comment)
                    <h4>[<a href="#" title="{{ $comment->user_id }}">
                            {{ $comment->user->name }}
                        </a>]
                    </h4>
                    <p class="body" style="text-align: justify">{{ $comment->body }}</p>
                    <div class="date-create">Дата создания: {{ $comment->created_at }}</div>
                    <div class="date-update">Дата обновления: {{ $comment->updated_at }}</div>
                @endforeach
            </div>
            <div class="comment-add" style="background-color: blue; color: white;">
                <h4 style="text-align: center">Добавить комментарий</h4>
                {!! Form::open(['route' => 'comments.store']) !!}
                {!! Form::hidden('article_id', $article->id) !!}
                <div class="form-group">
                    {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Add comment', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
