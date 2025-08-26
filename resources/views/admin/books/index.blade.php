@extends('layouts.admin')
@section('title', 'Manage Books')
@section('content')

<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Manage Books</h4>
        <a href="{{ route('admin.books.create') }}" class="btn btn-sm btn-primary">Add New Book</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Categories</th>
                <th width="200px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>${{ number_format($book->price, 2) }}</td>
                <td>
                    @if($book->is_available)
                    <span class="badge bg-success">Available</span>
                    @else
                    <span class="badge bg-danger">Unavailable</span>
                    @endif
                </td>
                <td>
                    @foreach($book->categories as $cat)
                    <span class="badge bg-secondary">{{ $cat->name }}</span>
                    @endforeach
                </td>
                <td>

                    <form action="{{ route('admin.books.toggle', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="btn btn-sm {{ $book->is_available ? 'btn-warning' : 'btn-success' }}">
                            {{ $book->is_available ? 'Hide' : 'Show' }}
                        </button>
                    </form>

                    <a href="{{ route('admin.books.edit', $book->id) }}"
                        class="btn btn-sm btn-primary">Edit</a>

                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                        style="display:inline;"
                        onsubmit="return confirm('you want to delete this book?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No books found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection