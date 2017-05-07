@extends('layouts.app')

@section('app')

<h1>記事一覧</h1>

    <ul>
        @foreach ($posts as $post)
            <li>
                {{ link_to_route('posts.show', $post->title, [$post->id]) }}
                {{ link_to_route('posts.edit', '[Edit]', [$post->id]) }}
            </li>
        @endforeach
        <li>
            {{ link_to_route('posts.create', '新しい記事の投稿') }}
        </li>
    </ul>

@endsection
