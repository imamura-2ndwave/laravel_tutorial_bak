@extends('layouts.app')

@section('title', '記事一覧')

@section('app')

@foreach ($posts as $post)
    <ul>
        <li>{{ $post->title }}</li>
    </ul>
@endforeach

@endsection
