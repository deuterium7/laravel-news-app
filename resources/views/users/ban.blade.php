@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="category-update">
                <h3 style="text-align: center;">@lang('catalog.ban')</h3>
                {!! Form::open(['route' => ['users.update', $user], 'method' => 'PUT']) !!}
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
                    <label for="ban">@lang('catalog.to') *</label>
                    {{ Form::text('ban', \Carbon\Carbon::now(), ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <div style="text-align: center">
                        <input type="submit" value="{{ trans('catalog.ban') }}" class="btn btn-primary">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
