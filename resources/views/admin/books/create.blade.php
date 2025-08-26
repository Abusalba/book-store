@extends('layouts.admin')
@section('title', 'Create New Book')
@section('content')

<div class="container mt-5">
    <h4 class="mb-4">Add New Book</h4>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}">
                        @error('author') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}">
                        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available') ? 'checked' : '' }} class="form-check-input">
                            <label for="is_available" class="form-check-label">Available</label>
                            @error('is_available') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="isbn" class="form-label">ISBN (optional)</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn') }}">
                        @error('isbn') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="publisher" class="form-label">Publisher (optional)</label>
                        <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher') }}">
                        @error('publisher') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="published_at" class="form-label">Published Date (optional)</label>
                        <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}">
                        @error('published_at') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="cover" class="form-label">Cover Image (optional)</label>
                        <input type="file" name="cover" id="cover" class="form-control">
                        @error('cover') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description (optional)</label>
                        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="categories" class="form-label">Categories (optional)</label>
                        <select name="categories[]" id="categories" class="form-select" multiple>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categories') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save Book</button>
                </div>
            </form>
        </div>
    </div>
    
    @endsection