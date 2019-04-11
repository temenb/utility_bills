<td class="td-meter-name">
        {{ $meter->name }}
        <form style="{{ $meter->name ? 'display:none' : '' }}" class="meter-form submit-by-post" action="{{ route('meter.crud.name') }}">@csrf<input class="autosubmit" name="name" size="7" /></form>
</td>
