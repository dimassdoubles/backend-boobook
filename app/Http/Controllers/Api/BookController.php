<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    // index method
    public function index()
    {
        // get books
        $books = Book::latest()->paginate(5);

        // return collections of books as a resource
        return new BookResource(true, 'List Data Books', $books);
    }

    // store method
    public function store(Request $request)
    {

        // define validation rules
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:book_categories,id',
            'title' => 'required',
            'author' => 'required',
            'year' => 'required',
            'publisher' => 'required',
            'synopsis' => 'required',
        ]);

        // if validadtion fails
        if ($validator->fails()) {
            return Response()->json($validator->errors(), 422);
        }

        // create books
        $book = Book::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
            'publisher' => $request->publisher,
            'synopsis' => $request->synopsis,
        ]);

        return new BookResource(true, 'Data Berhasil Ditambahkan!', $book);
    }

    // show method
    public function show(Book $book)
    {
        // return single book as a resource
        return new ApiResource(true, 'Data Book Ditemukan!', $book);
    }

    // update method
    public function update(Request $request, Book $book)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:book_categories,id',
            'title' => 'required',
            'author' => 'required',
            'year' => 'required',
            'publisher' => 'required',
            'synopsis' => 'required',
        ]);

        // if validation faild
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // update book
        $book->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
            'publisher' => $request->publisher,
            'synopsis' => $request->synopsis,
        ]);


        return new BookResource(true, 'Data Buku Berhasil Diubah!', $book);
    }


    // destroy method
    public function destroy(Book $book)
    {
        // delete book
        $book->delete();

        return new BookResource(true, 'Data Buku Berhasil Dihapus!', null);
    }
}
