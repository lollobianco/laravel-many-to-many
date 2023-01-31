@extends('layouts.app')

@section('title')
  Show: {{ $post->title }}
@endsection

@section('content')
  <div class="d-flex container justify-content-around">

    <div class="d-flex flex-column text-white col-6 p-4">

      <h2 class="mb-4">{{ $post->title }}</h2>

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

      <div class="container d-flex p-0 mt-auto">

        <div class="">
          <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline-warning mr-2">Edit Post</a>
        </div>

        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="">

          @csrf
          @method('DELETE')

          <button type="submit" class="btn btn-outline-danger">Delete Post</button>

        </form>

      </div>

    </div>

    @if (is_null($post->cover))
      <div class="rounded card-body col-4 bg-secondary d-flex align-items-center justify-content-center">
        <h2>No picture available</h2>
      </div>
    @else
      <div class="col-6 p-4 pt-0">
        <img src="{{ asset("storage/$post->cover") }}" alt="" class="w-100 rounded">
      </div>
    @endif

  </div>
@endsection
