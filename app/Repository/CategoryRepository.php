<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    private Category $categoryModel;

    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    public function list(): Collection
    {
        return $this->categoryModel::all();
    }

    public function get(int $categoryId): ?Category
    {
        return $this->categoryModel::find($categoryId) ?? null;
    }

    public function create(string $categoryName): void
    {
        $this->categoryModel::create([
            'name' => $categoryName
        ]);
    }

    public function update(Category $category, string $categoryName): void
    {
        $category->name = $categoryName;
        $category->save();
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}