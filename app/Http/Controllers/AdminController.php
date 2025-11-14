<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $books = Book::all();
        $activities = Activity::latest()->paginate(10);

        return view('admin.index', compact('users','books','activities'));
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')->latest()->get();

        return view('admin.users', compact('users'));
    }

    public function books()
    {
        $books = Book::latest()->get();

        return view('admin.books', compact('books'));
    }

    public function create_book()
    {
        return view('admin.create-book');
    }

    public function store_book(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'pages' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpj,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $image_name = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $image_name);
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'pages' => $request->pages,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $image_name,
            'status' => $request->status,
        ]);

        return redirect('admin/books')->with('success', 'Book created successfully.');
    }

    public function show_book($id) {
        $book = Book::find($id);

        return view('admin.show-book', compact('book'));
    }

    public function edit_book($id) {
        $book = Book::find($id);

        return view('admin.edit-book', compact('book'));
    }

    public function update_book(Request $request, $id) {
        $book = Book::find($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'pages' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpj,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        $image_name = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $image_name);
            $book->image = $image_name;
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->pages = $request->pages;
        $book->price = $request->price;
        $book->description = $request->description;
        $book->image = $image_name;
        $book->status = $request->status;
        $book->save();

        return redirect('admin/books')->with('success', 'Book updated successfully.');
    }

    public function delete_book($id) {
        $book = Book::find($id);
        $book->delete();

        return redirect('admin/books')->with('success', 'Book deleted successfully.');
    }
}
