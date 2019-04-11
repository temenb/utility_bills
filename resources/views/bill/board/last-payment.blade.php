@if ($meter->type == \App\Models\Entities\Meter::ENUM_TYPE_MEASURING )
        <td class="td-m-data-next"><input size="7" /></td>
@else
        @forelse($meter->mData as $mData)
                @if (\App\Models\Entities\MeterData::ENUM_POSITION_FUTURE === $mData->position)
                        <td class="td-m-data-next">{{$mData->charge_at}}</td>
                        @break;
                @endif
                @if ($loop->last)
                        <td class="td-m-data-next">{{ __(('Future date is not calculated yet.')) }}</td>
                @endif
        @empty
                <td class="td-m-data-next">{{ __(('Future date is not calculated yet.')) }}</td>
        @endforelse
@endif