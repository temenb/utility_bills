<td class="td-meter-type">
        {{ $meter->type }}
        <form style="{{ $meter->type ? 'display:none' : '' }}" class="meter-form submit-by-post" action="{{ route('meter.crud.type') }}">
                @csrf
                <select class="autosubmit" name="type">
                        @foreach(\App\Models\Entities\Meter::enumType() as $val)
                                <option value="{{$val}}">{{$val}}</option>
                        @endforeach
                </select><button type="submit">tick</button>
        </form>
</td>
