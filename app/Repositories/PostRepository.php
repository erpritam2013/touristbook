<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::orderBy('id','desc')->get();
    }
    public function getPostById($postId)
    {
        return Post::findOrFail($postId);
    }
    public function deletePost($postId)
    {
        Post::destroy($postId);
    }

    public function deleteBulkPost($postId)
    {
         Post::whereIn('id', $postId)->delete();
    }
    public function createPost(array $postDetails)
    {
        return Post::create($postDetails);
    }
    public function updatePost($postId, array $newDetails)
    {
        return Post::whereId($postId)->update($newDetails);
    }

    public function getActivePostList()
    {
        $postBuilder = Post::where('status', Post::ACTIVE)->get(['id','name']);

        return  $postBuilder;
    }

}
