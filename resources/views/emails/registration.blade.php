<div style="display: table; width: 100%; text-align: center; height: 40px; background: #68A4C4; color: #fff; font-family: 'Open Sans', Arial, sans-serif; font-size: 14px; font-weight: bold;">
    <div style="display: table-cell; vertical-align: middle;">{{ trans('catalog.thanksForRegistration') }}!</div>
</div>
<div>
    <div style="width: 50%; padding: 40px 25%; text-align: justify;">
        <h3>{{ trans('catalog.yourContacts') }}:</h3>
        <div>{{ trans('catalog.nameUser') }} - <strong>{{ $user->name }}</strong></div>
        <div>{{ trans('catalog.createdAt') }} - <strong>{{ $user->created_at }}</strong></div>
    </div>
</div>