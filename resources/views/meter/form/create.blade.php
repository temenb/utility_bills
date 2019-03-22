<form method="POST" action="{{ route('service.put') }}">
    @csrf

    <input type="hidden" name="_method" value="PUT">
    <div class="form-group row">
        <label for="organization" class="col-md-4 col-form-label text-md-right">{{ __('Organization') }}</label>

        <div class="col-md-6">
            <select id="organization" type="text" class="form-control{{ $errors->has('organization') ? ' is-invalid' : '' }}" name="organization" value="{{ old('organization') }}" required autofocus>
                @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('organization'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('organization') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="service" class="col-md-4 col-form-label text-md-right">{{ __('Service') }}</label>

        <div class="col-md-6">
            <select id="service" type="text" class="form-control{{ $errors->has('service') ? ' is-invalid' : '' }}" name="service" value="{{ old('service') }}" required autofocus>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('service'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('service') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
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