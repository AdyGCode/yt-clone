<?php

namespace App\Policies;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ChannelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Channel $channel)
    {
        return Response::allow();
        return $channel->belongsToUser($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Channel $channel)
    {
        // TODO: Check if user is Admin OR the Channel Owner.
        //       Currently, prescribe user #1 (admin in dummy data)
        //       and the logged in user if they are the channel owner
        return $user->id === $channel->user_id || $user->id === 1
            ? Response::allow()
            : Response::deny('You do not own this channel.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Channel $channel)
    {
        ddd($this);

        return Response::allow();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Channel $channel)
    {
        ddd($this);

        return Response::allow();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Channel $channel)
    {
        ddd($this);

        return Response::allow();
    }

    // TODO: Add the removeChannelVideo, updateChannelVideo, addChannelVideo policies
}
