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


                        <a class="btn btn-primary" href="{{ route('board.form') }}">
                            {{ __('Add Data') }}
                        </a>
                            <br /><br />
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Organization</th>
                                    <th>Service</th>
                                    <th>Period</th>
                                    <th>Rate</th>
                                    <th>Dept</th>
                                    <th>This month</th>
                                    <th>Total</th>
                                    <th>Payemnt</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($organizations as $organization)
                                @forelse ($organization->services as $service)
                                    @forelse ($service->meters as $meter)
                                        <tr>
                                            @if ($loop->parent->first && $loop->first)
                                                <td rowspan="{{ $organizationRowspan[$organization->id] }}">{{ $organization->name }}</td>
                                            @endif
                                            @if ($loop->first)
                                                <td rowspan="{{ count($service->meters) ?? 1 }}">{{ $service->name }}</td>
                                            @endif
                                            <td>{{ $meter->type }}</td>
                                            <td>{{ $meter->rate }}</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>{{ $organization->name }}</td>
                                            <td>{{ $service->name }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    @endforelse
                                @empty
                                    <tr>
                                        <td>{{ $organization->name }}</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                @endforelse
                            @endforeach
                            <tr>
                                <td colspan="4">&nbsp;</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>Total</td>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>

                        <a class="btn btn-primary" href="{{ route('board.form') }}">
                            {{ __('Add Data') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection