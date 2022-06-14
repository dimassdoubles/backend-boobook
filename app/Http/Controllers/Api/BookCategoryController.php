<?php

namespace App\Http\Controllers\Api;

use App\Models\BookCategory;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get book categories
        $book_categories = BookCategory::latest()->paginate(5);

        // return collection of posts as a resource
        return new ApiResource(true, 'List Data Book Categories', $book_categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create book category
        $book_category = BookCategory::create([
            'name' => $request->name,
        ]);

        // return response
        return new ApiResource(true, 'Data Book Category Berhasil Ditambahkan!', $book_category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book_category = BookCategory::find($id);

        // return single book category as a resource
        return new ApiResource(true, 'Data Book Category Ditemukan!', $book_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book_category = BookCategory::find($id);

        // define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book_category->update([
            'name' => $request->name,
        ]);

        return new ApiResource(true, 'Data Kategori Buku Berhasil Diubah!', $book_category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book_category = BookCategory::find($id);

        $book_category->delete();

        return new ApiResource(true, 'Data Kategori Buku Berhasil Dihapus!', $book_category);
    }
}
