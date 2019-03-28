<?php

namespace App\Policies;

use App\User;
use App\UserDetials;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserDetialsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user detials.
     *
     * @param  \App\User  $user
     * @param  \App\UserDetials  $userDetials
     * @return mixed
     */
    public function view(User $user, UserDetials $userDetials)
    {
        return $userDetials->user_id == $user->id;
    }

    /**
     * Determine whether the user can create user detials.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Auth::user()->id == $user->id;
    }

    /**
     * Determine whether the user can update the user detials.
     *
     * @param  \App\User  $user
     * @param  \App\UserDetials  $userDetials
     * @return mixed
     */
    public function update(User $user, UserDetials $userDetials)
    {
        return $user->id == $userDetials->user_id;
    }

    /**
     * Determine whether the user can delete the user detials.
     *
     * @param  \App\User  $user
     * @param  \App\UserDetials  $userDetials
     * @return mixed
     */
    public function delete(User $user, UserDetials $userDetials)
    {
        //return $user->user
    }

    /**
     * Determine whether the user can restore the user detials.
     *
     * @param  \App\User  $user
     * @param  \App\UserDetials  $userDetials
     * @return mixed
     */
    public function restore(User $user, UserDetials $userDetials)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user detials.
     *
     * @param  \App\User  $user
     * @param  \App\UserDetials  $userDetials
     * @return mixed
     */
    public function forceDelete(User $user, UserDetials $userDetials)
    {
        //
    }
}
