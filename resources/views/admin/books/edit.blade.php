@extends('layouts.admin')
@section('title', 'Edit Book')
@section('content')

<div class="container mt-5">
    <h4 class="mb-4">Edit Book</h4>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}">
                        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}">
                        @error('author') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $book->price) }}">
                        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check mt-4">
                            <input type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $book->is_available) ? 'checked' : '' }} class="form-check-input">
                            <label for="is_available" class="form-check-label">Available</label>
                            @error('is_available') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="isbn" class="form-label">ISBN (optional)</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
                        @error('isbn') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="publisher" class="form-label">Publisher (optional)</label>
                        <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher', $book->publisher) }}">
                        @error('publisher') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="published_at" class="form-label">Published Date (optional)</label>
                        <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at', $book->published_at) }}">
                        @error('published_at') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="cover" class="form-label">Cover Image (optional)</label>
                        <input type="file" name="cover" id="cover" class="form-control">
                        @if ($book->cover_path)
                        <img src="{{ asset('storage/' . $book->cover_path) }}" alt="Current Cover" class="img-fluid mt-2" style="max-width: 150px;">
                        @endif
                        @error('cover') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description (optional)</label>
                        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $book->description) }}</textarea>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="categories" class="form-label">Categories (optional)</label>
                        <select name="categories[]" id="categories" class="form-select" multiple>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('categories') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection