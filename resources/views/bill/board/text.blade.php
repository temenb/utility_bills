<td class="td-{{$tdClass}}}">
        {{ optional($entity)->$attribute }}
        <form style="{{ optional($entity)->$attribute ? 'display:none' : '' }}" class="submit-by-post" action="{{ $action }}">
                @csrf
                @if (optional($entity)->id)
                <input type="hidden" name="id" value="{{ $entity->id}}" />
                @endif
                @if (isset($hidden))
                        @foreach ($hidden as $key => $val)
                                <input type="hidden" name="{{$key}}" value="{{ $val }}" />
                        @endforeach
                @endif
                <input class="autosubmit" name="{{$attribute}}" value="{{ optional($entity)->$attribute }}" size="7" />
        </form>
</td>
