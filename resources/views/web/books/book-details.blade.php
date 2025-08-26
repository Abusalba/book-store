@extends('layouts.web')
@section('title', $book->title)
@section('content')

<div class="container my-5">
    <div class="row g-5">
        <div class="col-md-4">
            <div class="text-center mb-4">
                <img src="{{ asset('storage/'.$book->cover_path) }}"
                    alt="{{ $book->title }}"
                    class="img-fluid shadow rounded"
                    style="max-height: 500px;">
            </div>
        </div>

        <div class="col-md-8">
            <h1 class="fw-bold mb-3">{{ $book->title }}</h1>
            <p class="text-muted fs-5 mb-3">by {{ $book->author }}</p>

            <div class="mb-3">
                <span class="fs-3 text-info fw-bold">₹{{ number_format($book->price, 2) }}</span>
            </div>

            <div class="mb-4">
                <span class="badge {{ $book->is_available ? 'bg-success' : 'bg-danger' }} fs-6 px-3 py-2">
                    {{ $book->is_available ? 'Available' : 'Out of Stock' }}
                </span>
            </div>
            <div class="mb-4">
                <h4 class="fw-semibold mb-3">Description</h4>
                <p class="text-justify lh-lg">{{ $book->description }}</p>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="fw-semibold mb-3">Book Details</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted fw-medium">ISBN:</td>
                            <td>{{ $book->isbn }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium">Publisher:</td>
                            <td>{{ $book->publisher }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium">Published:</td>
                            <td>
                                {{ $book->published_at->format('Y-m-d') }}
                            </td>
                        </tr>
                        @if($book->categories->count())
                        <tr>
                            <td class="text-muted fw-medium">Categories:</td>
                            <td>{{ $book->categories->pluck('name')->join(', ') }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($relatedBooks->count())
    <div class="mt-5 pt-5 border-top">
        <h3 class="fw-semibold mb-4">Related Books</h3>
        <div class="row g-4">
            @foreach($relatedBooks as $related)
            <div class="col-6 col-md-3">
                <a href="{{ route('web.books.book-details', $related->slug) }}"
                    class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm border-0 hover-card">
                        <img src="{{ asset('storage/'.$related->cover_path) }}"
                            alt="{{ $related->title }}"
                            class="card-img-top"
                            style="height: 220px;">

                        <div class="card-body">
                            <h6 class="fw-bold text-truncate mb-1" title="{{ $related->title }}">
                                {{ $related->title }}
                            </h6>
                            <p class="text-muted small mb-1">{{ $related->author }}</p>
                            <p class="fw-bold text-info mb-0">₹{{ number_format($related->price, 2) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
<style>
    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .text-justify {
        text-align: justify;
    }
</style>
@endsection