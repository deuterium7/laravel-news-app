@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3 style="text-align: center;">Обновить новость</h3>
            {!! Form::open(['route' => ['articles.update', $article->id], 'method' => 'PUT']) !!}
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
                {!! Form::label('title') !!}
                {!! Form::text('title', $article->title, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('image') !!}
                {!! Form::text('image', $article->image, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('body') !!}
                {!! Form::textarea('body', $article->body, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <div style="text-align: center">
                    {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
