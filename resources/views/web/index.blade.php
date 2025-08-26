@extends('layouts.web')
@section('title', 'Home')
@section('content')

<div class="text-center py-5">
    <h4 class="mb-4">Discover Your Next Favorite Book</h4>
    <form action="{{ url('/books') }}" method="GET" class="d-flex justify-content-center mt-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search by title or author"
            class="form-control w-50 rounded-start">
        <button class="btn btn-info rounded-end px-4">
            Search
        </button>
    </form>
</div>

<section class="mt-5">
    <h4 class="mb-3 border-bottom pb-2">Latest Books</h4>
    <div class="row g-4">
        @forelse($latestBooks as $book)
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/' . $book->cover_path) }}" alt="{{ $book->title }}" class="card-img-top" style="height: 200px;">
                <div class="card-body p-2">
                    <h6 class="card-title mb-1 small">{{ Str::limit($book->title, 25) }}</h6>
                    <p class="text-muted small mb-1">{{ Str::limit($book->author, 20) }}</p>
                    <p class="fw-bold text-info mb-0 small">₹{{ $book->price }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <h5>No books available in our collection yet.</h5>
                <p class="mb-0">Please check back later or browse our trending books below!</p>
            </div>
        </div>
        @endforelse
    </div>
</section>

@if(!empty($googleBooks))
<section class="mt-5">
    <h4 class="fw-semibold mb-4 border-bottom pb-2">Trending Books (Google API)</h4>
    <div class="row g-4">
        @foreach($googleBooks as $gBook)
        @php
        $info = $gBook['volumeInfo'] ?? [];
        @endphp
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card h-100 shadow-sm">
                <img src="{{ $info['imageLinks']['thumbnail'] }}"
                    alt="{{ $info['title'] ?? 'Untitled' }}"
                    class="card-img-top"
                    style="height: 200px;
                    ">
                <div class="card-body p-2">
                    <h6 class="card-title mb-1 small">
                        {{ Str::limit($info['title'] ?? 'No Title', 25) }}
                    </h6>
                    <p class="text-muted small mb-1">
                        {{ Str::limit($info['authors'][0] ?? 'Unknown Author', 20) }}
                    </p>
                    <a href="{{ $info['infoLink'] ?? '#' }}" target="_blank" class="btn btn-sm btn-info w-100 mt-2">
                        View
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif
@endsection