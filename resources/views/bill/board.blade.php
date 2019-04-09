@extends('layouts.app')

@section('title')@parent - Page Title @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        {{--<a class="btn btn-primary" href="{{ route('board.form') }}">--}}
                            {{--{{ __('Add Data') }}--}}
                        {{--</a>--}}
                            <br /><br />
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Organization') }}</th>
                                    <th>{{ __('Service') }}</th>
                                    <th>{{ __('Meter') }}</th>
                                    <th>{{ __('Period') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Next charge') }}</th>
                                    <th>{{ __('Previous charge') }}</th>
                                    <th>{{ __('Organization Balance') }}</th>
                                    <th>{{ __('Service Balance') }}</th>
                                    <th>{{ __('Meter Balance') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($meters as $meter)
                                <tr>
                                    @if (optional($meter->service)->organization)
                                        <td>{{ $meter->service->organization->name }}</td>
                                    @else
                                        <td>&nbsp</td>
                                    @endif
                                    @if ($meter->service)
                                        <td>{{ $meter->service->name }}</td>
                                    @else
                                        <td>&nbsp</td>
                                    @endif
                                    <td>{{ $meter->name }}</td>
                                    <td>{{ $meter->type }}</td>
                                    <td>{{ $meter->rate }}</td>
                                    @if ($meter->type == \App\Models\Entities\Meter::ENUM_TYPE_MEASURING )
                                        <td><input size="7" /></td>
                                        @forelse($meter->mData as $mData)
                                            @if (\App\Models\Entities\MeterData::ENUM_POSITION_CURRENT === $mData->position)
                                                <td>{{$mData->value}} / {{$mData->charge_at}}</td>
                                                @break
                                            @endif
                                            @if ($loop->last)
                                                <td>{{ __(('Past data are absent')) }}</td>
                                            @endif
                                        @empty
                                            <td>{{ __(('Past data are absent')) }}</td>
                                        @endforelse
                                    @else
                                        @forelse($meter->mData as $mData)
                                            @if (\App\Models\Entities\MeterData::ENUM_POSITION_FUTURE === $mData->position)
                                                <td>{{$mData->charge_at}}</td>
                                                @break;
                                            @endif
                                            @if ($loop->last)
                                                <td>{{ __(('Future date is not calculated yet.')) }}</td>
                                            @endif
                                        @empty
                                            <td>{{ __(('Future date is not calculated yet.')) }}</td>
                                        @endforelse
                                        @forelse($meter->mData as $mData)
                                            @if (\App\Models\Entities\MeterData::ENUM_POSITION_CURRENT === $mData->position)
                                                <td>{{$mData->charge_at}}</td>
                                                @break;
                                            @endif
                                            @if ($loop->last)
                                                <td>{{ __(('Past data are absent')) }}</td>
                                            @endif
                                        @empty
                                            <td>{{ __(('Past data are absent')) }}</td>
                                        @endforelse
                                    @endif
                                    <td>{{ rand(-1000, 1000) }}&nbsp;<button>p</button></td>
                                    <td>{{ rand(-1000, 1000) }}&nbsp;<button>p</button></td>
                                    <td>{{ rand(-1000, 1000) }}&nbsp;<button>p</button></td>
                                </tr>
                            @endforeach
                            {{--<tr>--}}
                                {{--<td>&nbsp;</td>--}}
                                {{--<td>&nbsp;</td>--}}
                                {{--<td>&nbsp;</td>--}}
                                {{--<td>&nbsp;</td>--}}
                                {{--<td>Total</td>--}}
                                {{--<td>Total</td>--}}
                                {{--<td>Total</td>--}}
                                {{--<td>&nbsp;</td>--}}
                            {{--</tr>--}}
                            </tbody>
                        </table>

                        {{--<a class="btn btn-primary" href="{{ route('board.form') }}">--}}
                            {{--{{ __('Add Data') }}--}}
                        {{--</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

