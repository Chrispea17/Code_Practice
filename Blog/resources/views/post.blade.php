@extends('layouts')
@section('content')
    <h1>{{$post->title; }}</h1>
    <div>{!! $post->body; !!}</div>
    <a href="/">All posts</a>
@endsection
