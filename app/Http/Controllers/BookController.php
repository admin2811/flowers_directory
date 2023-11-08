<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Book::latest()->paginate(8);
        return view('books.index' , compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "Title" => "required",
            "Author" => "required",
            "Genre" => "required",
            "PublicationYear" => "required",
            "ISBN" => "required",
            "CoverImageURL" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('CoverImageURL')) {
            $image = $request->file('CoverImageURL');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $name); 
        }
        $book = Book::create([
            'Title' => $request->input('Title'),
            'Author' => $request->input('Author'),
            'Genre' => $request->input('Genre'),
            'PublicationYear' => $request->input('PublicationYear'),
            'ISBN' => $request->input('ISBN'),
            'CoverImageURL' => 'img/' . $name, // Lưu đường dẫn tương đối của hình ảnh
        ]);
    
        if ($book) {
            Toastr::success('Add Successfully');
            return redirect()->route('books.index');
        }else{
            Toastr::error('Add Failed');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.update',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(),[
            "Title" => "required",
            "Author" => "required",
            "Genre" => "required",
            "PublicationYear" => "required",
            "ISBN" => "required",
            "CoverImageURL" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('CoverImageURL')) {
            $image = $request->file('CoverImageURL');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $name); 
            $book->CoverImageURL = 'img/' . $name;
        }
        $book->update([
            'Title' => $request->input('Title'),
            'Author' => $request->input('Author'),
            'Genre' => $request->input('Genre'),
            'PublicationYear' => $request->input('PublicationYear'),
            'ISBN' => $request->input('ISBN'),
        ]);
        Toastr::success('Update Successfully');
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        Toastr::success('Delete The Book Successfully!', 'Success');
        return redirect()->route('books.index');
    }
}
