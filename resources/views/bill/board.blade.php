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
                                    <th>Organization</th>
                                    <th>Service</th>
                                    <th>Meter</th>
                                    <th>Dept</th>
                                    <th>This month</th>
                                    <th>Total</th>
                                    <th>Payemnt</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($organizations as $organization)
                                @foreach ($organization->services as $service)
                                    @foreach ($service->meters as $meter)
                                <tr>
                                    @if ($loop->parent->first && $loop->first)
                                        <td rowspan="{{ $organizationRowspan[$organization->id] }}">{{ $organization->name }}</td>
                                    @endif
                                    @if ($loop->first)
                                        <td rowspan="{{ count($service->meters) ?? 1 }}">{{ $service->name }}</td>
                                    @endif
                                    <td>{{ $meter->type }}</td>
                                    @if ($loop->parent->first && $loop->first)
                                        <td rowspan="{{ $organizationRowspan[$organization->id] }}">{{ curr_format($organization->accounts[0]->value) }}</td>
                                        <td rowspan="{{ $organizationRowspan[$organization->id] }}">{{ curr_format($organization->accounts[0]->value) }}</td>
                                        <td rowspan="{{ $organizationRowspan[$organization->id] }}">{{ curr_format($organization->accounts[0]->value) }}</td>
                                        <td rowspan="{{ $organizationRowspan[$organization->id] }}">{{ curr_format($organization->accounts[0]->value) }}</td>
                                    @endif
                                </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection