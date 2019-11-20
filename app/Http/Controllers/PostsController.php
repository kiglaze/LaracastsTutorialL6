<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    //
    public function show($slug) {
//        $post = \DB::table('posts')->where('slug', $slug)->first();
//        $post = Post::where('slug', $slug)->first();
        $post = Post::where('slug', $slug)->firstOrFail();

//        if(!$post) {
//            abort(404, 'Page not found.');
//        }

        return view('post', [
            'post' => $post
        ]);
    }
}
