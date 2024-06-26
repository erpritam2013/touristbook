<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function getPostById($postId);
    public function deletePost($postId);
    public function forceDeletePost($postId);
    public function forceBulkDeletePost($postId);
    public function deleteBulkPost($postId);
    public function createPost(array $postDetails);
    public function updatePost($postId, array $newDetails);
    public function getActivePostList();
}