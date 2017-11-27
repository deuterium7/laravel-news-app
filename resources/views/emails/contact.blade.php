<div style="display: table; width: 100%; text-align: center; height: 40px; background: #68A4C4; color: #fff; font-family: 'Open Sans', Arial, sans-serif; font-size: 14px; font-weight: bold;">
    <div style="display: table-cell; vertical-align: middle;">{{ trans('catalog.msgFromUser') }} {{ $contact['user'] }}!</div>
</div>
<div>
    <div style="width: 50%; padding: 40px 25%; text-align: justify;">
        <div>{{ trans('catalog.title') }} - <strong>{{ $contact['title'] }}</strong></div>
        <div>{{ trans('catalog.message') }} - <strong>{{ $contact['message'] }}</strong></div>
    </div>
</div>