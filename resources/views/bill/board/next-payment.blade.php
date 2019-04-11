@forelse($meter->mData as $mData)
        @if (\App\Models\Entities\MeterData::ENUM_POSITION_CURRENT === $mData->position)
                <td class="td-m-data-last">{{$mData->value}} / {{$mData->charge_at}}</td>
                @break
        @endif
        @if ($loop->last)
                <td class="td-m-data-last">{{ __(('Past data are absent')) }}</td>
        @endif
@empty
        <td class="td-m-data-last">{{ __(('Past data are absent')) }}</td>
@endforelse
