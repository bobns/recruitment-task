<?php

namespace App\Http\Controllers;

use App\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->categoryRepository = $category;
    }

    public function index()
    {
        $categories = $this->categoryRepository->list();

        return view('category.categories', ['categories' => $categories]);
    }

    public function create()
    {
        return view('category.create-category-form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => ['required', 'string', 'min:3', 'max:100']
        ]);

        $this->categoryRepository->create($data['category']);

        return redirect()->route('categories')->with('message', 'Category has been added succesfully');
    }

    public function edit(int $categoryId)
    {
        $category = $this->categoryRepository->get($categoryId);

        if ($category) {
            return view('category.edit-category-form', ['category' => $category]);
        } else {
            abort(404, 'Category not found');
        }
    }

    public function update(int $categoryId, Request $request)
    {
        $data = $request->validate([
            'category' => ['required', 'string', 'min:3', 'max:100']
        ]);

        $category = $this->categoryRepository->get($categoryId);

        if ($category) {
            $this->categoryRepository->update($category, $data['category']);
            return redirect()->route('categories')->with('message', 'Category has been updated succesfully');
        } else {
            abort(404, 'Category not found');
        }
    }

    public function destroy(int $categoryId, Request $request)
    {
        $categoryId = (int) $request->input('category_id');
        $category = $this->categoryRepository->get($categoryId);

        if ($category) {
            $this->categoryRepository->delete($category);
            return redirect()->route('categories')->with('message', 'Category has been deleted succesfully');
        } else {
            abort(404, 'Category not found');
        }
    }
}