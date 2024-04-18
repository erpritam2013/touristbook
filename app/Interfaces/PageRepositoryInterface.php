<?php

namespace App\Interfaces;

interface PageRepositoryInterface
{
    public function getAllPages();
    public function getPageById($pageId);
    public function forceDeletePage($pageId);
    public function forceBulkDeletePage($pageId);
    public function deletePage($pageId);
    public function deleteBulkPage($pageId);
    public function createPage(array $pageDetails);
    public function updatePage($pageId, array $newDetails);
    public function getPageByType($pageId, string $type);
}