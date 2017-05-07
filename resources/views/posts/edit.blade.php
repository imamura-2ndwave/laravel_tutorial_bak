@extends('layouts.app')

@section('app')

<h1>記事編集</h1>

{{ Form::open(['route' => ['posts.update', $post->id], 'method' => 'put']) }}
    @include('posts._form')

    {{ Form::submit('更新') }}
{{ Form::close() }}

@endsection
