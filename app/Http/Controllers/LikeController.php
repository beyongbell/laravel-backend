<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LikeController extends Controller
{
    public function store(Request $request, Topic $topic, Post $post)
    {
        Gate::authorize('like', $post);
        if ($request->user()->hasLikedPost($post)) {
            return response(null, 409);
        }
        $like = new Like;
        $like->user()->associate($request->user());
        $post->likes()->save($like);
        return response(null, 204);
    }
}
