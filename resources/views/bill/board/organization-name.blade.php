<td @if ($organization) data-organization-id="{{ $organization->id }}" @endif class="td-organization-name">
        {{ optional($organization)->name }}
        <form style="{{ optional($organization)->name ? 'display:none' : '' }}" class="organization-form submit-by-post" action="{{ route('organization.crud.name') }}">@csrf<input class="autosubmit" name="name" size="7" /></form>
</td>
