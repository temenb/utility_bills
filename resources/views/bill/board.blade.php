@extends('layouts.app')

@section('title')@parent - Page Title @endsection

@section('content')
    <table>
        <thead>
            <tr>
                <th>1</th>
                <th>2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2</td>
            </tr>
        </tbody>

    </table>

    <script>
        $(document).ready( function () {
            $('table').DataTable({
                "bPaginate": false
            });
        })
    </script>
@endsection