@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="container mt-5">
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Books</h5>
                    <p class="badge bg-primary">{{ $totalBooks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Available / Unavailable</h5>
                    <p class="badge badge bg-success">{{ $availableBooks }} / {{ $totalBooks - $availableBooks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <p class="badge bg-info">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="mb-4">Latest 5 Books</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestBooks as $book)
                        <tr>
                            <td style="text-align: center;">
                                <img src="{{ asset('storage/' . $book->cover_path) }}" alt="{{ $book->title }}" class="img-fluid" style="max-width: 60px;">
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>${{ number_format($book->price, 2) }}</td>
                            <td>
                                <span class="badge {{ $book->is_available ? 'bg-success' : 'bg-danger' }}">
                                    {{ $book->is_available ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection