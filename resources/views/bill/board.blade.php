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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Organization') }}</th>
                                    <th>{{ __('Service') }}</th>
                                    <th>{{ __('Meter') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Period') }}</th>
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
                                <tr class="meter-id-holder" data-meter-id="{{ $meter->id }}">
                                    @include('bill.board.text', [
                                        'entity' => optional($meter->service)->organization,
                                        'property' => 'name',
                                        'tdClass' => 'organization-name',
                                        'action' => route('organization.crud.update'),
                                        'hidden' => ['service_id' => optional($meter->service)->id],
                                    ])
                                    @include('bill.board.text', [
                                        'entity' => $meter->service,
                                        'property' => 'name',
                                        'tdClass' => 'service-name',
                                        'action' => route('service.crud.update'),
                                        'hidden' => ['meter_id' => $meter->id],
                                    ])
                                    @include('bill.board.text', [
                                        'entity' => $meter,
                                        'property' => 'name',
                                        'tdClass' => 'meter-name',
                                        'action' => route('meter.crud.update')
                                    ])
                                    @include('bill.board.meter-type', ['meter' => $meter])
                                    @include('bill.board.text', [
                                        'entity' => $meter,
                                        'property' => 'rate',
                                        'tdClass' => 'meter-rate',
                                        'action' => route('meter.crud.update')
                                    ])
                                    @include('bill.board.meter-period', ['meter' => $meter])
                                    @include('bill.board.last-payment', ['meter' => $meter])
                                    @include('bill.board.next-payment', ['meter' => $meter])
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
                            <tr class="meter-id-holder new-data" style="display:none">
                                <td class="td-organization"><form><input class="autosubmit" size="7" />@csrf</form></tdtd-organization>
                                <td class="td-service"><form><input class="autosubmit" size="7" />@csrf</form></td>
                                @include('bill.board.text', [
                                    'entity' => new \App\Models\Entities\Meter(),
                                    'property' => 'name',
                                    'tdClass' => 'meter-name',
                                    'action' => route('meter.crud.update')
                                ])
                                @include('bill.board.meter-type', ['meter' => new \App\Models\Entities\Meter()])
                                @include('bill.board.text', [
                                    'entity' => new \App\Models\Entities\Meter(),
                                    'property' => 'rate',
                                    'tdClass' => 'meter-rate',
                                    'action' => route('meter.crud.update')
                                ])
                                @include('bill.board.meter-period', ['meter' => new \App\Models\Entities\Meter()])
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
                            {{ __('Add Meter') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/bill/board.js') }}"></script>
@append

@section('stylesheet')
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@append