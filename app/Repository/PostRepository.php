<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    private Post $postModel;

    public function __construct(Post $post)
    {
        $this->postModel = $post;
    }

    public function list(): ?Collection
    {
        return $this->postModel::with('categories')->get();
    }

    public function get(int $postId): ?Post
    {
        return $this->postModel::find($postId);
    }

    public function create(array $data): void
    {
        $post = $this->postModel::create([
            'title' => $data['title'],
            'message' => $data['message'],
            'user_id' => $data['user_id']
        ]);

        $post->categories()->sync($data['category']);
    }

    public function update(Post $post, array $data): void
    {
        $post->title = $data['title'];
        $post->message = $data['message'];
        $post->categories()->sync($data['category']);
        $post->save();
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }
}