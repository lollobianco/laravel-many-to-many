@extends('layouts.app')

@section('content')
  <div class="container p-5 text-white">

    <h1 class="text-center p-4">Create Post</h1>

    <form method="POST" action="{{ route('admin.posts.store') }}">

      @csrf

      <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror">
        @error('title')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="body" class="form-control @error('body') is-invalid @enderror"></textarea>
        @error('body')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div>
        <label class="form-label">Category</label>
        <select class="form-control w-100 mb-3" name="category_id">
          <option selected>Select a Category</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <label class="form-label form-check-label mb-2">Tags</label>
      <div class="d-flex mb-3">

        @foreach ($tags as $tag)
          <div class="mr-4">
            <input type="checkbox" class="check" name="tags[]" value="{{ $tag->id }}">
            {{ $tag->name }}
          </div>
        @endforeach

      </div>

      <button type="submit" class="btn btn-primary">Create Post</button>

    </form>

  </div>
@endsection
