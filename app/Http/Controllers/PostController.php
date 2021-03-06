<?php

namespace App\Http\Controllers;

use App\Repository\CategoryRepositoryInterface;
use App\Repository\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;
    private $categoryRepository;

    public function __construct(PostRepositoryInterface $post, CategoryRepositoryInterface $category)
    {
        $this->postRepository = $post;
        $this->categoryRepository = $category;
    }

    public function dashboard()
    {
        $user = auth()->user();
        return view('dashboard', ['user' => $user]);
    }

    public function index()
    {
        $this->authorize('read');

        $posts = $this->postRepository->list();

        return view('post.posts', ['posts' => $posts]);
    }

    public function create()
    {
        $this->authorize('create');

        $categories = $this->categoryRepository->list();
        return view('post.create-post-form', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $this->authorize('create');

        $data = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'category' => ['required', 'array',],
            'message' => ['required', 'string', 'min:10', 'max:400']
        ]);

        $data['user_id'] = auth()->user()->id;

        $this->postRepository->create($data);

        return redirect()->route('posts')->with('message', 'Post has been added succesfully');
    }

    public function edit(int $postId)
    {
        $post = $this->postRepository->get($postId);

        $this->authorize('edit-posts', $post);

        $categories = $this->categoryRepository->list();

        if ($post) {
            return view('post.edit-post-form', ['post' => $post, 'categories' => $categories]);
        } else {
            abort(404, 'Post not found');
        }
    }

    public function update(int $postId, Request $request)
    {
        $post = $this->postRepository->get($postId);

        $this->authorize('edit-posts', $post);

        $data = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'category' => ['required', 'array',],
            'message' => ['required', 'string', 'min:10', 'max:400']
        ]);

        if ($post) {
            $this->postRepository->update($post, $data);
            return redirect()->route('posts')->with('message', 'Post has been updated succesfully');
        } else {
            abort(404, 'Post not found');
        }
    }

    public function destroy(int $postId, Request $request)
    {
        $this->authorize('delete');

        $postId = (int) $request->input('post_id');
        $post = $this->postRepository->get($postId);

        if ($post) {
            $this->postRepository->delete($post);
            return redirect()->route('posts')->with('message', 'Post has been deleted succesfully');
        } else {
            abort(404, 'Post not found');
        }
    }
}