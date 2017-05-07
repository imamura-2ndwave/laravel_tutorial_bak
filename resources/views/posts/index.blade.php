@extends('layouts.app')

@section('app')

<h1>記事一覧</h1>

@foreach ($posts as $post)
    <ul>
        <li>{{ link_to_route('posts.show', $post->title, [$post->id]) }}</li>
    </ul>
@endforeach

@endsection
