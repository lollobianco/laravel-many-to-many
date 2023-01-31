@extends('layouts.app')

@section('title')
  Show: {{$post->title}}
@endsection

@section('content')
  <div class="container d-flex flex-column text-white">

    <h2 class="my-4">{{ $post->title }}</h2>

    <h5 class="mb-4">{{ $post->category['name'] }}</h5>

    <img src="{{asset("storage/$post->cover")}}" alt="">

    <div>
      @foreach ($post->tags as $tag)
        @if (is_null($tag->name))
        @else
          <span class="badge bg-light text-dark mb-4">{{ $tag['name'] }}</span>
        @endif
      @endforeach
    </div>

    <p>{{ $post->body }}</p>

  </div>

  <div class="container d-flex">

    <div>
      <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline-warning mr-2">Edit Post</a>
    </div>

    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">

      @csrf
      @method('DELETE')

      <button type="submit" class="btn btn-outline-danger">Delete Post</button>

    </form>

  </div>
@endsection
