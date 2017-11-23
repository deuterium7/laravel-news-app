@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="center">@lang('catalog.news')</h3>
            {!! Form::open(['method' => 'Get', 'route' => ['admin.news']]) !!}
                <div class="form-group">
                    <label for="keywords">@lang('catalog.searchByTitle')</label>
                    {{ Form::text('keywords', null, ['class'=>'form-control']) }}
                </div>
            {!! Form::close() !!}
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>@lang('catalog.title')</th>
                        <th>@lang('catalog.category')</th>
                        <th>@lang('catalog.visibility')</th>
                        <th>@lang('catalog.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->category->name }}</td>
                            <td>
                                @if($article->visibility)
                                    @lang('catalog.true')
                                @else
                                    @lang('catalog.false')
                                @endif
                            </td>
                            <td>
                                {!! Form::open(['method' => 'Get', 'route' => ['articles.edit', $article->id]]) !!}
                                    <input type="submit" class="btn btn-warning" value="@lang('catalog.edit')">
                                {!! Form::close() !!}
                                {!! Form::open(['method' => 'Delete', 'route' => ['articles.destroy', $article->id], 'onsubmit' => 'return confirm("Are you sure?")']) !!}
                                    <input type="submit" class="btn btn-danger" value="@lang('catalog.destroy')">
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! Form::open(['method' => 'Get', 'route' => ['articles.create']]) !!}
                <input type="submit" class="btn btn-success" value="@lang('catalog.create')">
            {!! Form::close() !!}
            <div class="links">{{ $articles->links() }}</div>
        </div>
    </div>
@endsection
