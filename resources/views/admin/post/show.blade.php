@extends('layouts.app')

@section('content')
  <div class="container d-flex flex-column align-items-center text-white">

    <h2 class="my-4">{{ $post->title }}</h2>

    <h5 class="mb-4">{{ $post->category['name'] }}</h5>

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
@endsection
