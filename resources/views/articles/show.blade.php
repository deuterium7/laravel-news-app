@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="article">
                <div class="clearfix">
                    <div class="col-md-4"><img src="{{ $article->image }}"></div>
                    <div class="col-md-8">
                        <h2 class="center">{{ $article->title }}</h2>
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
                        <p>{{ $article->body }}</p>
                        @if($article->updated_at <= $article->created_at)
                            <div>@lang('catalog.createdAt'): {{ $article->created_at->format('d.m.Y H:i:s') }}</div>
                        @else
                            <div>@lang('catalog.updatedAt'): {{ $article->updated_at->format('d.m.Y H:i:s') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            @if ($errors->any())
                @component('components.alert')
                @endcomponent
            @endif
            <div class="comment-add">
                <h4 class="center">@lang('catalog.addComment')</h4>
                {!! Form::open(['route' => 'comments.store']) !!}
                    {!! Form::hidden('article_id', $article->id) !!}
                    {!! Form::hidden('user_id', auth()->user()->id) !!}
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
                            @can('edit', $comment)
                                :<a href="{{ route('comments.edit', ['comment' => $comment->id]) }}" title="{{ trans('catalog.updateComment') }}">
                                    {{ trans('catalog.edit') }}
                                </a>
                            @endcan
                        </h5>
                        <p>{{ $comment->body }}</p>
                        @if($comment->updated_at <= $comment->created_at)
                            <div class="date-create">
                                @lang('catalog.createdAt'): {{ $comment->created_at->format('d.m.Y H:i:s') }}
                            </div>
                        @else
                            <div class="date-update">
                                @lang('catalog.updatedAt'): {{ $comment->updated_at->format('d.m.Y H:i:s') }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="links">{{ $comments->links() }}</div>
        </div>
    </div>
@endsection
