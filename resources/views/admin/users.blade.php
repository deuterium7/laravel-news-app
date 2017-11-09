@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3 style="text-align: center;">@lang('catalog.users')</h3>
            {!! Form::open(['method' => 'Get', 'route' => ['admin.users']]) !!}
                <div class="form-group">
                    <label for="keywords">@lang('catalog.searchByName')</label>
                    {{ Form::text('keywords', null, ['class'=>'form-control']) }}
                </div>
            {!! Form::close() !!}
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>@lang('catalog.name')</th>
                    <th>@lang('catalog.emailAddress')</th>
                    <th>@lang('catalog.ban')</th>
                    <th>@lang('catalog.createdAt')</th>
                    <th>@lang('catalog.actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->ban)
                                {{ $user->ban }}
                            @else
                                @lang('catalog.false')
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            {!! Form::open(['method' => 'Get', 'route' => ['users.ban', $user->id]]) !!}
                                <input type="submit" class="btn btn-warning" value="@lang('catalog.ban')">
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="text-align: center">{{ $users->links() }}</div>
        </div>
    </div>
@endsection
