<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get tranactions
        $transactions = Transaction::latest()->paginate(5);

        // return collection of posts as a resource
        return new ApiResource(true, 'List Transaksi Berhasil Dimuat!', $transactions);
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
            'user_id' => 'required|exists:users, id',
            'book_id' => 'required|exists:books, id',
            'status' => 'requied|in:SELESAI, DIPINJAM, DENDA',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create transaction
        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'status' => $request->status,
        ]);

        // return response
        return new ApiResource(true, 'Data Transaksi Berhasil Ditambahkan!', $transaction);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction =Transaction::find($id);
        
        // return single transaction as a resource
        return new ApiResource(true, 'Data Transaksi Ditemukan', $transaction);
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
        $transaction = Transaction::find($id);

        // define validation rules
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users, id',
            'book_id' => 'required|exists:books, id',
            'status' => 'requied|in:SELESAI, DIPINJAM, DENDA',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $transaction->update([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'status' => $request->status,
        ]);

        return new ApiResource(true, 'Data Transaksi Berhasil Diubah!', $transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        $transaction->delete();

        return new ApiResource(true, 'Data Transaksi Berhasil Dihapus!', $transaction);
    }
}
