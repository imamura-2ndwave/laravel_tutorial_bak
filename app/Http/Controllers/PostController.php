<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'   => 'required',
            'content' => 'required',
        ]);

        $post = Post::create($request->all());

        return redirect()->route('posts.index');
    }
}
