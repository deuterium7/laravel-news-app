@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="news-create" style="background-color: red; color: white;">
                <h3 style="text-align: center;">@lang('catalog.addCategory')</h3>
                {!! Form::open(['route' => 'categories.store']) !!}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="name">@lang('catalog.nameCategory')</label>
                    {{ Form::text('name', null, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="name">@lang('catalog.image')</label>
                    {{ Form::text('image', null, ['class'=>'form-control']) }}
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
