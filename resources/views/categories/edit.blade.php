@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="category-update">
                <h3 class="center">@lang('catalog.updateCategory')</h3>
                {!! Form::open(['route' => ['categories.update', $category], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                @if ($errors->any())
                    @component('components.alert')
                    @endcomponent
                @endif
                <div class="form-group">
                    <label for="name">@lang('catalog.nameCategory')</label>
                    {{ Form::text('name', $category->name, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="image">@lang('catalog.image') *</label>
                    {{ Form::file('image', ['accept'=>'.jpeg, .png, .jpg']) }}
                    <p class="help-block">@lang('catalog.categoryFileHelp')</p>
                </div>
                <div class="form-group">
                    <div class="links">
                        <input type="submit" value="{{ trans('catalog.update') }}" class="btn btn-primary">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
