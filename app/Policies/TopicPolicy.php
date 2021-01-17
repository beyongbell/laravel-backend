<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TopicPolicy
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

    public function update(User $user, Topic $topic)
    {
        return $user->id === $topic->user_id;
        // return $user->id === $topic->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }

    public function destroy(User $user, Topic $topic)
    {
        return $user->id === $topic->user_id;
    }
}
