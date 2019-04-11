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


                        <a class="btn btn-primary add-data" href="#">
                            {{ __('Add Data') }}
                        </a>
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
                                    <th>{{ __('Organization Prev Balance') }}</th>
                                    <th>{{ __('Organization Current Balance') }}</th>
                                    <th>{{ __('Organization Total Balance') }}</th>
                                    <th>{{ __('Service Prev Balance') }}</th>
                                    <th>{{ __('Service Current Balance') }}</th>
                                    <th>{{ __('Service Total Balance') }}</th>
                                    <th>{{ __('Meter Prev Balance') }}</th>
                                    <th>{{ __('Meter Current Balance') }}</th>
                                    <th>{{ __('Meter Total Balance') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($meters as $meter)
                                <tr data-meter-id="{{ $meter->id }}">
                                    @if (optional($meter->service)->organization)
                                        <td data-organization-id="{{ $meter->service->organization->id }}" class="td-organization">{{ $meter->service->organization->name }}</td>
                                    @else
                                        <td class="td-organization">&nbsp</tdtd-organization>
                                    @endif
                                    @if ($meter->service)
                                        <td data-service-id="{{ $meter->service->id }}" class="td-service">{{ $meter->service->name }}</td>
                                    @else
                                        <td class="td-service">&nbsp</td>
                                    @endif
                                    <td class="td-m-name">{{ $meter->name }}</td>
                                    <td class="td-m-type">{{ $meter->type }}</td>
                                    <td class="td-m-rate">{{ $meter->rate }}</td>
                                    @if ($meter->type == \App\Models\Entities\Meter::ENUM_TYPE_MEASURING )
                                        <td class="td-m-data-next"><input size="7" /></td>
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
                                        @forelse($meter->mData as $mData)
                                            @if (\App\Models\Entities\MeterData::ENUM_POSITION_CURRENT === $mData->position)
                                                <td class="td-m-data-last">{{$mData->charge_at}}</td>
                                                @break;
                                            @endif
                                            @if ($loop->last)
                                                <td class="td-m-data-last">{{ __(('Past data are absent')) }}</td>
                                            @endif
                                        @empty
                                            <td class="td-m-data-last">{{ __(('Past data are absent')) }}</td>
                                        @endforelse
                                    @endif
                                    <td>{{ rand(-1000, 1000) }}<button>p</button></td>
                                    <td>{{ rand(-1000, 1000) }}<button>p</button></td>
                                    <td>{{ rand(-1000, 1000) }}<button>p</button></td>
                                    <td>{{ rand(-1000, 1000) }}<button>p</button></td>
                                    <td>{{ rand(-1000, 1000) }}<button>p</button></td>
                                    <td>{{ rand(-1000, 1000) }}<button>p</button></td>
                                    <td>{{ rand(-1000, 1000) }}<button>p</button></td>
                                    <td>{{ rand(-1000, 1000) }}<button>p</button></td>
                                    <td>{{ rand(-1000, 1000) }}<button>p</button></td>
                                </tr>
                            @endforeach
                            <tr class="data-tr-new" style="display:none">
                                <td class="td-organization"><form><input size="7" /></form></tdtd-organization>
                                <td class="td-service"><form><input size="7" /></form></td>
                                <td class="td-m-name"><form><input size="7" /></form></td>
                                <td class="td-m-type"><form><input size="7" /></form></td>
                                <td class="td-m-rate"><form><input size="7" /></form></td>
                                <td class="td-m-data-next"></td>
                                <td class="td-m-data-last"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>

                        <a class="btn btn-primary add-data" href="#">
                            {{ __('Add Data') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script
            src="https://code.jquery.com/jquery-3.4.0.min.js"
            integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
            crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
            integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
            crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/bill/board.js') }}"></script>
@append

@section('stylesheet')
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@append