<td @if ($service) data-service-id="{{ $service->id }}" @endif class="td-service-name">
        {{ optional($service)->name }}
        <form style="{{ optional($service)->name ? 'display:none' : '' }}" class="service-form submit-by-post" action="{{ route('service.crud.name') }}">@csrf<input class="autosubmit" name="name" size="7" /></form>
</td>
