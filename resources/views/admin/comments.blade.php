@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3 style="text-align: center;">@lang('catalog.comments')</h3>
            {!! Form::open(['method' => 'Get', 'route' => ['admin.comments']]) !!}
                <div class="form-group">
                    <label for="keywords">@lang('catalog.searchByComment')</label>
                    {{ Form::text('keywords', null, ['class'=>'form-control']) }}
                </div>
            {!! Form::close() !!}
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>@lang('catalog.comment')</th>
                    <th>@lang('catalog.article')</th>
                    <th>@lang('catalog.user')</th>
                    <th>@lang('catalog.actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->article->title }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>
                            {!! Form::open(['method' => 'Delete', 'route' => ['comments.destroy', $comment->id]]) !!}
                                <input type="submit" class="btn btn-danger" value="@lang('catalog.destroy')">
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="text-align: center">{{ $comments->links() }}</div>
        </div>
    </div>
@endsection
