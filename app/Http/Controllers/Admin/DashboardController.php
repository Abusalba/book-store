<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::where('is_available', true)->count();
        $totalCategories = Category::count();
        $latestBooks = Book::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalBooks', 'availableBooks', 'totalCategories', 'latestBooks'));
    }
}
