<td class="td-meter-period">
        @if (\App\Models\Entities\Meter::ENUM_TYPE_MEASURING != $meter->type)
        {{ $meter->period ? \App\Models\Entities\Meter::enumPeriod($meter->period) : $meter->period }}
        @endif
        <form style="{{ $meter->period ? 'display:none' : '' }}" class="meter-form submit-by-post" action="{{ route('meter.crud.period') }}">
                @csrf
                <select class="autosubmit" name="period">
                        @foreach(\App\Models\Entities\Meter::enumPeriod() as $val)
                        <option value="{{$val}}">{{$val}}</option>
                        @endforeach
                </select><button type="submit">tick</button>
        </form>
</td>
