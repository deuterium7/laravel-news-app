@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="news-create" style="background-color: red; color: white;">
                <h3 style="text-align: center;">Добавить новость</h3>
                {!! Form::open(['route' => 'articles.store']) !!}
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
                    {!! Form::label('category') !!}
                    <select id="category" class="form-control" name="category" required>
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}" {{ (int)$id === (int) old('category') ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('title') !!}
                    {!! Form::text('title', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('image') !!}
                    {!! Form::text('image', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('body') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
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
