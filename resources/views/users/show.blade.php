@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('catalog.profile') {{ $user->name }}</div>

                    <div class="panel-body">
                        @if($user->updated_at <= $user->created_at)
                            <div>@lang('catalog.createdAt'): {{ $user->created_at }}</div>
                        @else
                            <div>@lang('catalog.updatedAt'): {{ $user->updated_at }}</div>
                        @endif
                        <div>@lang('catalog.emailAddress'): {{ $user->email }}</div>
                        <hr>
                        <div class="comments">@lang('catalog.lastComments')
                            @foreach($comments as $comment)
                                <div class="comment" style="margin-top: 10px;">
                                    <div class="col-md-6" style="text-align: center;">
                                        @lang('catalog.in') <a href="{{ route('articles.show', ['article' => $comment->article_id]) }}">@lang('catalog.theme')</a>
                                    </div>
                                    <div class="col-md-6" style="text-align: center;">
                                        @if($comment->updated_at <= $comment->created_at)
                                            <div>@lang('catalog.createdAt'): {{ $comment->created_at }}</div>
                                        @else
                                            <div>@lang('catalog.updatedAt'): {{ $comment->updated_at }}</div>
                                        @endif
                                    </div>
                                    <div class="body" style="text-align: justify;">{{ $comment->body }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
