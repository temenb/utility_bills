<td class="td-{{$tdClass}}}">
        {{ optional($entity)->$property }}
        <form style="{{ optional($entity)->$property ? 'display:none' : '' }}" class="submit-by-post" action="{{ $action }}">
                @csrf
                @if ($entity)->id)
                <input type="hidden" name="id" value="{{ $entity->id}}" />
                @endif
                @if (isset($hidden))
                        @foreach ($hidden as $key => $val)
                                <input type="hidden" name="{{$key}}" value="{{ $val }}" />
                        @endforeach
                @endif
                <input class="autosubmit" name="{{$property}}" value="{{ optional($entity)->$property }}" size="7" />
        </form>
</td>
