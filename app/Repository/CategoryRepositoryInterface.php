<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function list(): ?Collection;
    public function get(int $categoryId): ?Category;
    public function update(Category $category, string $categoryName): void;
    public function create(array $data): void;
    public function delete(Category $category): void;
}