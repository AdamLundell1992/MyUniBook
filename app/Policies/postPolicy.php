<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\post;
class postPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, post $post)
    {
        return $user->id == $post->user_id;
    }
    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, post $post)
    {
        return $user->id == $post->user_id;

    }
    public function delete(User $user, post $post)
    {
        return $user->id == $post->user_id;
    }

    public function restore(User $user,post $post)
    {

    }

    public function forceDelete(User $user, post $post)
    {
        //
    }
}
