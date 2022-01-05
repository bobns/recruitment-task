<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function create(array $data): void;
    public function list(): ?Collection;
    public function get(int $postId): ?Post;
    public function update(Post $post, array $data): void;
    public function delete(Post $post): void;
}