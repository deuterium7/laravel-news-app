@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="news-create" style="background-color: red; color: white;">
                <h3 style="text-align: center;">Добавить новость</h3>
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
                    {!! Form::label('name') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('image') !!}
                    {!! Form::text('image', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <div style="text-align: center">
                        {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
