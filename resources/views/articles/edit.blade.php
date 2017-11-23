@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="news-update">
                <h3 class="center">@lang('catalog.updateNews')</h3>
                {!! Form::open(['route' => ['articles.update', $article->id], 'method' => 'PUT']) !!}
                @if ($errors->any())
                    @component('components.alert')
                    @endcomponent
                @endif
                <div class="form-group">
                    <label for="title">@lang('catalog.title')</label>
                    {{ Form::text('title', $article->title, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="image">@lang('catalog.image')</label>
                    {{ Form::text('image', $article->image, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="body">@lang('catalog.body')</label>
                    {{ Form::textarea('body', $article->body, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="visibility">@lang('catalog.visibility')</label>
                    {{ Form::checkbox('visibility', 1, $article->visibility) }}
                </div>
                <div class="form-group">
                    <div class="submit">
                        <input type="submit" value="{{ trans('catalog.update') }}" class="btn btn-primary">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
