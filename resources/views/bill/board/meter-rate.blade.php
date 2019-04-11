<td class="td-m-name">
        {{ $meter->rate }}
        <form style="{{ $meter->rate ? 'display:none' : '' }}" class="meter-form submit-by-post" action="{{ route('meter.crud.rate') }}">@csrf<input class="autosubmit" name="rate" size="7" /></form>
</td>
