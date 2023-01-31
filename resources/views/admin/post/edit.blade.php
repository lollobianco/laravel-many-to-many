@extends('layouts.app')

@section('title')
  Edit: {{$post->title}}
@endsection

@section('content')
  <div class="container text-white">

    <h1 class="text-center p-4">Modify Post</h1>

    <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">

      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Title:</label>
        <input name="title" value="{{ $post->title }}" type="text"
          class="form-control @error('title') is-invalid @enderror">
        @error('title')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Description:</label>
        <textarea name="body" class="form-control @error('body') is-invalid @enderror">
          {{ $post->body }}
        </textarea>
        @error('description')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div>
        <label class="form-label">Category:</label>
        <select class="form-control w-100 mb-3" name="category_id">
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <label class="form-label form-check-label mb-2">Tags:</label>

      <div class="d-flex mb-4">

        @foreach ($tags as $tag)
          <div class="cat action btn btn-outline-light p-0 mr-2">
            <label>
              <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $post->tags->contains($tag) ? 'checked' : '' }}>
                <span>{{ $tag->name }}</span>
            </label>
          </div>
        @endforeach

      </div>

      <div class="mb-4">
        <label class="form-label form-check-label" for="">Image</label>
        <input type="file" name="image" class="form-control-file">
      </div>

      <button type="submit" class="btn btn-primary">Modify Post</button>

    </form>

  </div>
@endsection
