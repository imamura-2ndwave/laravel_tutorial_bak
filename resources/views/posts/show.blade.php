@extends('layouts.app')

@section('app')

<h1>{{ $post->title }}</h1>

<div>
    {{ $post->content }}
</div>

@endsection
