@extends('layouts.app')

@section('title')@parent - Page Title @endsection

@section('content')
    <table>
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

    <script>
        $(document).ready( function () {
            // $('table').DataTable({
            //     paging: false,
            //     info: false,
            //     searching: false
            // });
        })
    </script>
@endsection