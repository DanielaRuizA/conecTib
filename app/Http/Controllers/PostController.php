<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index(Request $request)
    {
        //controlador para llamar la api y el buscador del userId
        $search = $request->input('search');

        $data = Http::get('https://jsonplaceholder.typicode.com/posts')->json();

        if ($search) {
            $data = array_filter($data, function ($post) use ($search) {
                return stripos($post['userId'], $search) !== false;
            });
        }

        return view('posts.index', ['data' => $data, 'search' => $search]);
    }
}
