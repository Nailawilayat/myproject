<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display all books.
     */
    public function index()
    {
        $books = Book::latest()->get();

        return view('books.index', compact('books'));
    }

    /**
     * Display a single book.
     */
    public function show($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

        // Sidebar ke "Recent Books" ke liye — current book ke ilawa baaki books
        $allBooks = Book::where('id', '!=', $book->id)
                         ->latest()
                         ->get();

        return view('books.show', compact('book', 'allBooks'));
    }

    /**
     * Search books.
     */
    public function search(Request $request)
    {
        $q = $request->get('q');

        $books = Book::where(function ($query) use ($q) {
                        $query->where('title', 'like', "%{$q}%")
                              ->orWhere('author', 'like', "%{$q}%"); // optional
                    })
                    ->latest()
                    ->get();

        return view('books.index', compact('books'));
    }
}