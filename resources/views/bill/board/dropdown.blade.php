<td class="td-meter-type">
        {{ optional($entity)->$attribute }}
        <form style="{{ optional($entity)->$attribute ? 'display:none' : '' }}" class="submit-by-post" action="{{ $action }}">
                @csrf
                <select class="autosubmit" name="type">
                        @foreach($dropdownData as $val)
                                <option value="{{$val}}">{{$val}}</option>
                        @endforeach
                </select><button type="submit">tick</button>
        </form>
</td>
