@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="news-update" style="background-color: red; color: white;">
                <h3 style="text-align: center;">Обновить новость</h3>
                {!! Form::open(['route' => ['comments.update', $comment->id], 'method' => 'PUT']) !!}
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
                    {!! Form::label('body') !!}
                    {!! Form::textarea('body', $comment->body, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <div style="text-align: center">
                        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
