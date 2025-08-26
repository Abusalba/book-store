<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('categories')->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $availableCategories = Category::all();

        return view('admin.books.create', ['categories' => $availableCategories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric',
            'isbn' => 'nullable|string',
            'publisher' => 'nullable|string',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('cover')) {
            $coverFile = $request->file('cover');
            $validated['cover_path'] = $coverFile->store('covers', 'public');
        }

        $book = Book::create($validated);

        if ($request->has('categories')) {
            $book->categories()->sync($request->get('categories', []));
        }

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        $allCategories = Category::all();

        return view('admin.books.edit', ['book' => $book, 'categories' => $allCategories]);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $updatedData = $request->validated();

        if ($request->hasFile('cover')) {
            if (! empty($book->cover_path) && Storage::disk('public')->exists($book->cover_path)) {
                Storage::disk('public')->delete($book->cover_path);
            }

            $newCover = $request->file('cover');
            $updatedData['cover_path'] = $newCover->store('covers', 'public');
        }

        $updatedData['slug'] = Str::slug($updatedData['title']);

        $book->update($updatedData);

        $categoriesToSync = $request->get('categories', []);
        $book->categories()->sync($categoriesToSync);

        return redirect()->route('admin.books.index')->with('success', 'Book information has been updated successfully!');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_path && Storage::disk('public')->exists($book->cover_path)) {
            Storage::disk('public')->delete($book->cover_path);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book has been deleted successfully!');
    }

    public function toggleAvailability(Book $book)
    {
        $currentStatus = $book->is_available;
        $newStatus = ! $currentStatus;

        $book->update(['is_available' => $newStatus]);

        $statusMessage = $newStatus ? 'Book is now available' : 'Book is now unavailable';

        return redirect()->route('admin.books.index')->with('success', $statusMessage);
    }
}
