@extends('layouts.app')

@section('app')

<h1>記事投稿</h1>

{{ Form::open(['route' => ['posts.store']]) }}
    @include('posts._form')

    {{ Form::submit('投稿') }}
{{ Form::close() }}

@endsection
