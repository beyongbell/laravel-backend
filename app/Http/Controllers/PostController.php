<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    public function store(PostStoreRequest $request, Topic $topic)
    {
        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->posts()->save($post);
        return new PostResource($post);
    }

    public function update(PostUpdateRequest $request, Topic $topic, Post $post)
    {
        Gate::authorize('update', $post);
        $post->body = $request->body;
        $post->save();
        return new PostResource($post);
    }

    public function destroy(Topic $topic, Post $post)
    {
        Gate::authorize('destroy', $post);
        $post->delete();
        return response(null, 204);
    }
}
