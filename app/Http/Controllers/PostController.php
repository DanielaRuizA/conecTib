<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Controlador para llamar la API y el buscador del userId
        $search = $request->input('search');

        try {
            $data = Http::get('https://jsonplaceholder.typicode.com/posts')->json();

            if ($search) {
                $data = array_filter($data, function ($post) use ($search) {
                    return stripos($post['userId'], $search) !== false;
                });
            }

            Log::info('Consulta exitosa a la API de posts.', ['search' => $search]);

            return view('posts.index', ['data' => $data, 'search' => $search]);
        } catch (\Exception $e) {
            Log::error('Error al realizar la consulta a la API de posts.', ['error' => $e->getMessage(), 'search' => $search]);
        }
    }
}
