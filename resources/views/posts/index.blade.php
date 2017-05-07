@extends('layouts.app')

@section('app')

<h1>記事一覧</h1>

@foreach ($posts as $post)
    <ul>
        <li>{{ $post->title }}</li>
    </ul>
@endforeach

@endsection
