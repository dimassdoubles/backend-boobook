<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\BookGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all images
        $images = BookGallery::latest()->paginate(5);

        return new ApiResource(true, 'List Data Gambar', $images);
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
            'book_id' => 'required|exists:books,id',
            'image_url' => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return Response()->json($validator->errors(), 422);
        }

        // create image
        $image = BookGallery::create([
            'book_id' => $request->book_id,
            'image_url' => $request->image_url,
        ]);

        return new ApiResource(true, 'Data Berhasil Ditambahkan!', $image);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = BookGallery::find($id);

        // return single book category as a resource
        return new ApiResource(true, 'Data Gambar Ditemukan!', $image);
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
        $image = BookGallery::find($id);

        // define validation rules
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books, id',
            'image_url' => 'required',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image->update([
            'book_id' => $request->book_id,
            'image_url' => $request->image_url,
        ]);

        return new ApiResource(true, 'Data Gambar Berhasil Diubah!', $image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = BookGallery::find($id);
        
        $image->delete();

        return new ApiResource(true, 'Data Gambar Berhasil Dihapus!', $image);
    }
}
