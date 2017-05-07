<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function show($post)
    {
        $post = Post::find($post);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $post = new Post();

        return view('posts.create', compact('post'));
    }

    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        return redirect()->route('posts.index');
    }

    public function edit($post)
    {
        $post = Post::find($post);

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $post)
    {
        $post = Post::find($post);
        $post->update($request->all());

        return redirect()->route('posts.index');
    }

    public function destroy($post)
    {
        $post = Post::find($post);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
