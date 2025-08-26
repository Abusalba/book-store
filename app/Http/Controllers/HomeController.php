<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $latestBooks = Book::available()->latest()->take(6)->get();
        $categories = Category::all();

        $googleBooks = Cache::remember('google_books_trending', 86400, function () {
            try {
                $response = Http::timeout(10)->get('https://www.googleapis.com/books/v1/volumes', [
                    'q' => 'subject:fiction',
                    'maxResults' => 6,
                    'orderBy' => 'relevance',
                    'key' => config('services.google_books.key'),
                ]);

                if ($response->successful()) {
                    return $response->json('items', []);
                }

                Log::error('Google Books API failed: '.$response->status().' - '.$response->body());

                return [];
            } catch (Exception $e) {
                Log::error('Google Books API exception: '.$e->getMessage());

                return [];
            }
        });

        return view('web.index', compact('latestBooks', 'categories', 'googleBooks'));
    }

    public function bookListing(Request $request)
    {
        $query = Book::available();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('author', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        $books = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('web.books.index', compact('books', 'categories'));
    }

    public function bookDetail($slug)
    {
        $book = Book::available()->where('slug', $slug)->firstOrFail();

        $relatedBooks = Book::available()
            ->whereHas('categories', function ($q) use ($book) {
                $q->whereIn('categories.id', $book->categories->pluck('id'));
            })
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();

        return view('web.books.book-details', compact('book', 'relatedBooks'));
    }
}
