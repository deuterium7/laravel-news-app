@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3 style="text-align: center;">@lang('catalog.categories')</h3>
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>@lang('catalog.nameCategory')</th>
                    <th>@lang('catalog.image')</th>
                    <th>@lang('catalog.actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->image }}</td>
                        <td>
                            {!! Form::open(['method' => 'Get', 'route' => ['categories.edit', $category->id]]) !!}
                                <input type="submit" class="btn btn-warning" value="@lang('catalog.edit')">
                            {!! Form::close() !!}
                            {!! Form::open(['method' => 'Delete', 'route' => ['categories.destroy', $category->id], 'onsubmit' => 'return confirm("Are you sure?")']) !!}
                                <input type="submit" class="btn btn-danger" value="@lang('catalog.destroy')">
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! Form::open(['method' => 'Get', 'route' => ['categories.create']]) !!}
                <input type="submit" class="btn btn-success" value="@lang('catalog.create')">
            {!! Form::close() !!}
        </div>
    </div>
@endsection
