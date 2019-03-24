<?php

namespace App\Policies;

use App\Models\Entities\User;
use App\Models\Entities\Organization;
use Auth;

trait CommonFlowTrait
{
    public function isOwner(User $user, Organization $organization) {
        return $organization->owner_id == $user->id;
    }

    public function create() {
        return Auth::check();
    }

    public function update(User $user, Organization $organization) {
        return $this->isOwner($user, $organization);
    }

    public function view(User $user, Organization $organization) {
        return Auth::check();
    }

    public function delete(User $user, Organization $organization) {
        return $this->isOwner($user, $organization);
    }
}
