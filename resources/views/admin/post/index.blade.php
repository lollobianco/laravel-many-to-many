@extends('layouts.app')
@section('title', 'All recipes')

@section('content')
  <div class="container d-flex flex-column align-items-center">

    @foreach ($posts as $post)
      <div class="card mb-4 bg-secondary text-white" style="width: 28rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h3 class="card-title">{{ $post->title }}</h3>

          @foreach ($post->tags as $tag)
            @if (is_null($tag->name))
            @else
              <span class="badge bg-light text-dark mb-3">{{ $tag['name'] }}</span>
            @endif
          @endforeach

          @if (is_null($post->category))
            <p class="card-text">{{ $post->body }}</p>
          @else
            <div class="d-flex">
              <h4 class="card-text mb-2">{{ $post->category['name'] }}</h4>
            </div>
            <div class="card-text mb-3">{{ $post->body }}</div>
          @endif


          <div class="d-flex">

            <div>
              <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary mr-3">
                Show Post
              </a>
            </div>
            <div>
              <a class="btn btn-warning mr-3" href="{{ route('admin.posts.edit', $post->id) }}">
                Edit Post
              </a>
            </div>

            <form class="ml-auto" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">

              @csrf
              @method('DELETE')
        
              <button type="submit" class="btn btn-danger">Delete Post</button>
        
            </form>

          </div>

        </div>
      </div>
    @endforeach

    <div>{{ $posts->links() }}</div>

  </div>
@endsection
