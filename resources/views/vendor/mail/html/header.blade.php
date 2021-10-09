<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('img/logo.png') }}" width="202" height="51" class="d-inline-block align-top" alt="">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
