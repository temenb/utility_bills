@extends('layouts.app')

@section('title')@parent - Page Title @endsection

@section('content')
    <table>
        <thead>
            <tr>
                <th>Organization</th>
                <th>Service</th>
                <th>Meter</th>
                <th>Acount</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($organizations as $organization)
            @foreach ($organization->services as $service)
                @foreach ($service->meters as $meter)
            <tr>
                <td>{{ $organization->name }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $meter->type }}</td>
                <td>{{ curr_format($organization->accounts[0]->value) }}</td>
            </tr>
                @endforeach
            @endforeach
        @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready( function () {
            $('table').DataTable({
                paging: false,
                info: false,
                searching: false
            });
        })
    </script>
@endsection