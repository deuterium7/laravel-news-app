@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="news-update">
                <h3 class="center">@lang('catalog.updateComment')</h3>
                {!! Form::open(['route' => ['comments.update', $comment->id], 'method' => 'PUT']) !!}
                @if ($errors->any())
                    @component('components.alert')
                    @endcomponent
                @endif
                <div class="form-group">
                    <label for="body">@lang('catalog.body')</label>
                    {{ Form::textarea('body', $comment->body, ['class'=>'form-control']) }}
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
