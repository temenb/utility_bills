<?php

namespace App\Policies;

use App\Models\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Auth;

trait CommonFlowTrait
{
    public function isOwner(User $user, Model $organization) {
        return $organization->owner_id == $user->id;
    }

    public function create() {
        return Auth::check();
    }

    public function update(User $user, Model $organization) {
        return $this->isOwner($user, $organization);
    }

    public function view(User $user, Model $organization) {
        return Auth::check();
    }

    public function delete(User $user, Model $organization) {
        return $this->isOwner($user, $organization);
    }
}
