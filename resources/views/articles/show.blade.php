@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="article">
                <div class="clearfix">
                    <div class="col-md-4"><img src="{{ $article->image }}"></div>
                    <div class="col-md-8">
                        <h2>{{ $article->title }}</h2>
                        <h4>@lang('catalog.category'):
                            <a href="{{ route('categories.show', ['id' => $article->category_id]) }}" title="{{ $article->category->name }}">
                                {{ $article->category->name }}
                            </a>
                        </h4>
                        <h4>@lang('catalog.author'):
                            <a href="{{ route('users.show', ['user' => $article->user_id]) }}" title="{{ $article->user->name }}">
                                {{ $article->user->name }}
                            </a>
                        </h4>
                        <p style="text-align: justify">{{ $article->body }}</p>
                        @if($article->updated_at <= $article->created_at)
                            <div>@lang('catalog.createdAt'): {{ $article->created_at }}</div>
                        @else
                            <div>@lang('catalog.updatedAt'): {{ $article->updated_at }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="comment-add">
                <h4 style="text-align: center">@lang('catalog.addComment')</h4>
                {!! Form::open(['route' => 'comments.store']) !!}
                {!! Form::hidden('article_id', $article->id) !!}
                <div class="form-group">
                    {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group" style="text-align: center">
                    <input type="submit" value="{{ trans('catalog.create') }}" class="btn btn-primary">
                </div>
                {!! Form::close() !!}
            </div>
            <div class="comments">
                @foreach($comments as $comment)
                    <div class="comment">
                        <h5>
                            [<a href="{{ route('users.show', ['user' => $comment->user_id]) }}" title="{{ $comment->user->name }}">
                                {{ $comment->user->name }}
                            </a>]
                            @if(Auth::user()->id === $comment->user_id)
                                :<a href="{{ route('comments.edit', ['comment' => $comment->id]) }}" title="{{ trans('catalog.updateComment') }}">
                                    {{ trans('catalog.edit') }}
                                </a>
                            @endif
                        </h5>
                        <p class="body" style="text-align: justify">{{ $comment->body }}</p>
                        @if($comment->updated_at <= $comment->created_at)
                            <div class="date-create" style="text-align: right">
                                @lang('catalog.createdAt'): {{ $comment->created_at }}
                            </div>
                        @else
                            <div class="date-update" style="text-align: right">
                                @lang('catalog.updatedAt'): {{ $comment->updated_at }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div style="text-align: center">{{ $comments->links() }}</div>
        </div>
    </div>
@endsection
