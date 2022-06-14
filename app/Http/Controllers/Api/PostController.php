<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function index()
    {
        // get posts
        $posts = Post::latest()->paginate(5);

        // return collection of posts as a resource
        return new PostResource(true, 'List Data Posts', $posts);
    }

    public function store(Request $request)
    {
        // define validation rule
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'content' => 'required',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        // create post
        $post = Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return new PostResource(true, 'Data Berhasil Ditambahkan!', $post);
    }


    public function show(Post $post)
    {
        return new PostResource(true, 'Data Berhasil Ditemukan!', $post);
    }


    public function update(Request $request, Post $post)
    {

        // define validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        // check if validation failed
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // check if image not empty
        if ($request->hasFile('image')) {

            // upload image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            // delete old image
            Storage::delete('public/posts' . $post->image);
        } else {
            // update post without image
            $post->update(
                [
                    'title' => $request->title,
                    'content' => $request->content,
                ]
            );
        }

        return new PostResource(true, 'Data Berhasil Diubah!', $post);
    }


    public function destroy(Post $post)
    {
        // delete image
        Storage::delete('public/post' . $post->image);

        // delete post
        $post->delete();

        return new PostResource(true, 'Data Berhasil Dihapus!', null);
    }
}
