@extends('layouts.app')

@section('title')@parent - Page Title @endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <form method="POST" action="{{ route('meter.put-extended') }}">
                        @csrf

                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group row">
                            <label for="organization_id"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Organization') }}</label>

                            <div class="col-md-6">
                                <select id="organization_id" type="text"
                                        class="form-control{{ $errors->has('organization_id') ? ' is-invalid' : '' }}"
                                        name="organization_id" required autofocus>
                                    <option value="{{ App\Http\Requests\Meter\CreateExtendedRequest::NEW_ORGANIZATION }}">{{ __('New Organization') }}</option>
                                @foreach($organizations as $organization)
                                    <option {{ old('organization_id') == $organization->id ? 'selected="selected"' : '' }}  value="{{ $organization->id }}">{{ $organization->name }}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('organization_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('organization_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="organization[name]"
                                   class="col-md-4 col-form-label text-md-right">{{ __('New Organization') }}</label>
                            <div class="col-md-6">
                                <input id="organization[name]" type="text"
                                       class="form-control{{ $errors->has('organization.name') ? ' is-invalid' : '' }}" name="organization[name]"
                                       value="{{ old('organization.name') }}">

                                @if ($errors->has('organization.name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('organization.name') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="service_id"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Service') }}</label>

                            <div class="col-md-6">
                                <select id="service_id" type="text"
                                        class="form-control{{ $errors->has('service_id') ? ' is-invalid' : '' }}"
                                        name="service_id" value="{{ old('service_id') }}">
                                    <option value="{{ App\Http\Requests\Meter\CreateExtendedRequest::NEW_SERVICE }}">{{ __('New Service') }}</option>
                                    @foreach($services as $service)
                                        <option {{ old('service_id') == $service->id ? 'selected="selected"' : '' }} value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('service_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('service_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="service[name]"
                                   class="col-md-4 col-form-label text-md-right">{{ __('New Organization') }}</label>
                            <div class="col-md-6">
                                <input id="service[name]" type="text"
                                       class="form-control{{ $errors->has('service.name') ? ' is-invalid' : '' }}" name="service[name]"
                                       value="{{ old('service.name') }}">

                                @if ($errors->has('service.name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('service.name') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Meter type') }}</label>

                            <div class="col-md-6">
                                <select id="type" type="text"
                                        class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                        name="type" value="{{ old('type') }}">
                                    @foreach(App\Models\Entities\Meter::enumType() as $key => $val)
                                        <option {{ old('type') == $val ? 'selected="selected"' : '' }} value="{{ $val }}">{{ __($key) }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rate" class="col-md-4 col-form-label text-md-right">{{ __('Rate') }}</label>

                            <div class="col-md-6">
                                <input id="rate" type="text"
                                       class="form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}" name="rate"
                                       value="{{ old('rate') }}">

                                @if ($errors->has('rate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection