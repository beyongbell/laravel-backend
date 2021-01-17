<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\TopicUpdateRequest;
use App\Http\Resources\Topic as TopicResource;
use Illuminate\Support\Facades\Gate;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::latest()->paginate(5);
        return TopicResource::collection($topics);
    }

    public function store(TopicCreateRequest $request)
    {
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->user()->associate($request->user());

        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->save();
        $topic->posts()->save($post);

        return new TopicResource($topic);
    }

    public function show(Topic $topic)
    {
        return new TopicResource($topic);
    }

    public function update(TopicUpdateRequest $request, Topic $topic)
    {
        Gate::authorize('update', $topic);
        $topic->title = $request->title;
        $topic->save();
        return new TopicResource($topic);
    }
}
