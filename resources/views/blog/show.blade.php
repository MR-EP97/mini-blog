@extends('layouts.app')

@section('title', __('مقاله'))

@section('content')
    @livewire('blog.blog-show', ['slug' => request()->route('slug')])
@endsection
