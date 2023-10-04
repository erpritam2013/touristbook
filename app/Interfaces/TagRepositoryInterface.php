<?php

namespace App\Interfaces;

interface TagRepositoryInterface 
{
    public function getAllTags();
    public function getTagById($tagId);
    public function deleteTag($tagId);
    public function deleteBulkTag($tagIds);
    public function createTag(array $tagDetails);
    public function updateTag($tagId, array $newDetails);
    public function getTagsByType(string $type);

    public function getActiveTagsList($type);
}
