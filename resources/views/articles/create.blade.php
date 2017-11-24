@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="news-create">
                <h3 style="text-align: center;">@lang('catalog.addNews')</h3>
                {!! Form::open(['route' => 'articles.store', 'enctype' => 'multipart/form-data']) !!}
                @if ($errors->any())
                    @component('components.alert')
                    @endcomponent
                @endif
                <div class="form-group">
                    <label for="category_id">@lang('catalog.category')</label>
                    <select id="category_id" class="form-control" name="category_id" required>
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}" {{ (int)$id === (int) old('category') ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{ Form::hidden('user_id', auth()->user()->id) }}
                <div class="form-group">
                    <label for="title">@lang('catalog.title') *</label>
                    {{ Form::text('title', null, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="image">@lang('catalog.image') *</label>
                    {{ Form::file('image', ['accept'=>'.jpeg, .png, .jpg']) }}
                </div>
                <div class="form-group">
                    <label for="body">@lang('catalog.body') *</label>
                    {{ Form::textarea('body', null, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="visibility">@lang('catalog.visibility')</label>
                    {{ Form::checkbox('visibility', 1, true) }}
                </div>
                <div class="form-group">
                    <div style="text-align: center">
                        <input type="submit" value="{{ trans('catalog.create') }}" class="btn btn-primary">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
