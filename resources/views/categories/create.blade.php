@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="news-create">
                <h3 class="center">@lang('catalog.addCategory')</h3>
                {!! Form::open(['route' => 'categories.store']) !!}
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
                    {{ Form::text('image', 'http://img.image-storage.com/a1f3cecc7/DSCN1022d5d2ee6.JPG', ['class'=>'form-control']) }}
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
