<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function __construct() {
        if (!Auth::check()) {
            return redirect('/login')->with('Accessed denied. Unauthenticated!');
        }
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->get();
        
        return view('dashboard.book', compact('books'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric',
            'pages' => 'required|integer',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image_name = uniqid().'.'.$request->image->extension();$request->image->move(public_path('images'), $image_name);
        } else {
            $image_name = null;
        }

        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'pages' => $request->pages,
            'description' => $request->description,
            'image' => $image_name,
        ]);
        // INSERT INTO TABLE books () VALUES ();

        /* $book = new Book();
        $book->user_id = Auth::id();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->pages = $request->pages;
        $book->description = $request->description;
        $book->image = $image_name;
        $book->save(); */
        

        return redirect()->back()->with('success', 'Book added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        
        if ($book->user_id !== Auth::id()) {
            return redirect('/dashboard/books')->with('error', 'Accessed denied. Unauthorized!');
        }

        return view('dashboard.edit-book', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        $book->destroy();

        return redirect()->back()->with('success', 'Book added successfully');
    }
}
