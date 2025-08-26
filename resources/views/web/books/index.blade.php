@extends('layouts.web')
@section('title', 'All Books')
@section('content')

<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col-md-4">
            <h4>All Books</h4>
        </div>
        <div class="col-md-8">
            <form action="{{ route('web.books.books') }}" method="GET" class="d-flex">
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by title or author"
                    class="form-control me-2">
                <select name="category" class="form-select me-2" style="max-width: 200px;">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-info">Search</button>
            </form>
        </div>
    </div>

    @if($books->count())
    <div class="row g-4">
        @foreach($books as $book)
        <div class="col-6 col-sm-4 col-md-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="position-relative overflow-hidden">
                    <img src="{{ asset('storage/' . $book->cover_path) }}"
                        class="card-img-top"
                        alt="{{ $book->title }}"
                        style="height: 280px;  transition: transform 0.3s ease;">
                    <span class="position-absolute top-0 end-0 m-2 badge {{ $book->is_available ? 'bg-success' : 'bg-danger' }}">
                        {{ $book->is_available ? 'Available' : 'Out of Stock' }}
                    </span>
                </div>
                <div class="card-body d-flex flex-column p-3">
                    <h6 class="card-title fw-bold text-truncate mb-1" title="{{ $book->title }}">
                        {{ $book->title }}
                    </h6>
                    <p class="card-text text-muted small mb-1 text-truncate" title="{{ $book->author }}">
                        by {{ $book->author }}
                    </p>
                    <p class="fw-bold text-info mb-2">
                        ₹{{ number_format($book->price, 2) }}
                    </p>
                    <a href="{{ route('web.books.book-details', $book->slug) }}"
                        class="btn btn-info btn-sm mt-auto">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="bi bi-book" style="font-size: 4rem; color: #dee2e6;"></i>
        </div>
        <h4 class="text-muted mb-3">No books found</h4>
        <p class="text-muted mb-4">
            @if(request('search'))
            No books match your search term "{{ request('search') }}".
            @else
            No books are currently available.
            @endif
        </p>
        @if(request()->hasAny(['search', 'category']))
        <a href="{{ route('web.books.books') }}" class="btn btn-info">
            Show All Books
        </a>
        @endif
    </div>
    @endif
</div>
<style>
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }

    .card {
        transition: all 0.3s ease;
    }

    .badge {
        font-size: 0.7rem;
    }
</style>
@endsection