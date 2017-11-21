@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3 style="text-align: center;">@lang('catalog.contactUs')</h3>
            {!! Form::open(['route' => 'home.send']) !!}
            @if ($errors->any())
                @component('components.alert')
                @endcomponent
            @endif
            <div class="form-group">
                {{ Form::hidden('user', auth()->user()->name, ['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                <label for="title">@lang('catalog.title') *</label>
                {{ Form::text('title', null, ['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                <label for="message">@lang('catalog.message') *</label>
                {{ Form::textarea('message', null, ['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {!! NoCaptcha::display() !!}
            </div>
            <div class="form-group">
                <div style="text-align: center">
                    <input type="submit" value="{{ trans('catalog.send') }}" class="btn btn-primary">
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
