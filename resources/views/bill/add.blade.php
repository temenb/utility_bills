@extends('layouts.app')

@section('title')@parent - Page Title @endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Organization</div>

                    <div class="card-body">
                        @include('organization.form.create')
                    </div>
                </div>
                <div><br /></div>
                <div class="card">
                    <div class="card-header">Add Service</div>

                    <div class="card-body">
                        @include('service.form.create')
                    </div>
                </div>
                <div><br /></div>
                <div class="card">
                    <div class="card-header">Add Service</div>

                    <div class="card-body">
                        @include('meter.form.create')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection