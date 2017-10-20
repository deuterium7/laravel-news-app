@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4"><img src="{{ $article->image }}"></div>
            <div class="col-md-8">
                <h2 style="text-align: center">{{ $article->title }}</h2>
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
                @if($article->created_at)
                    <div class="col-md-6">Дата создания: {{ $article->created_at }}</div>
                    @if($article->created_at != $article->updated_at)
                        <div class="col-md-6">Дата обновления: {{ $article->updated_at }}</div>
                    @endif
                @endif
            </div>
        </div>
        <h4 style="text-align: center">Добавить комментарий</h4>
        {!! Form::open(['route' => 'comments.store']) !!}
            {!! Form::hidden('articles_id', $article->id) !!}
            <div class="form-group">
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Add comment', ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
