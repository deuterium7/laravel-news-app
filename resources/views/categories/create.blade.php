@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="news-create">
                <h3 class="center">@lang('catalog.addCategory')</h3>
                {!! Form::open(['route' => 'categories.store', 'enctype' => 'multipart/form-data']) !!}
                @if ($errors->any())
                    @component('components.alert')
                    @endcomponent
                @endif
                <div class="form-group">
                    <label for="name">@lang('catalog.nameCategory') *</label>
                    {{ Form::text('name', null, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="image">@lang('catalog.image') *</label>
                    {{ Form::file('image', ['accept'=>'.jpeg, .png, .jpg']) }}
                </div>
                <div class="form-group">
                    <div class="links">
                        <input type="submit" value="{{ trans('catalog.create') }}" class="btn btn-primary">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
