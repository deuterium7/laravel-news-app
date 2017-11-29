@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('catalog.profile') {{ $user->name }}</div>

                    <div class="panel-body">
                        @if($user->admin)
                            <div class="role">@lang('catalog.admin')</div>
                        @else
                            <div class="role">@lang('catalog.user')</div>
                        @endif
                        @if($user->updated_at <= $user->created_at)
                            <div>@lang('catalog.registeredAt'): {{ $user->created_at->diffForHumans() }}</div>
                        @else
                            <div>@lang('catalog.updatedAt'): {{ $user->updated_at->diffForHumans() }}</div>
                        @endif
                        <div>@lang('catalog.emailAddress'): {{ $user->email }}</div>
                        @if(count($comments) > 0)
                            <hr>
                            <div class="comments">@lang('catalog.lastComments')
                                @foreach($comments as $comment)
                                    <div class="comment">
                                        <div class="col-md-6">
                                            @lang('catalog.in') <a href="{{ route('articles.show', ['article' => $comment->article_id]) }}" title="{{ $comment->article->title }}">@lang('catalog.theme')</a>
                                        </div>
                                        <div class="col-md-6">
                                            @if($comment->updated_at <= $comment->created_at)
                                                <div>@lang('catalog.createdAt'): {{ $comment->created_at->format('d.m.Y H:i:s') }}</div>
                                            @else
                                                <div>@lang('catalog.updatedAt'): {{ $comment->updated_at->format('d.m.Y H:i:s') }}</div>
                                            @endif
                                        </div>
                                        <div class="body">{{ $comment->body }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
