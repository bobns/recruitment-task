<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function dashboard()
    {
        if (auth()->check()) {
            return view('dashboard');
        } else {
            redirect()->route('login');
        }
    }

    public function index()
    {
        return view('post.posts');
    }

    public function create()
    {
        return view('post.post-form');
    }
}