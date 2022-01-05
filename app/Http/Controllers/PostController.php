<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return view('dashboard');
        } else {
            redirect()->route('login');
        }
    }
}