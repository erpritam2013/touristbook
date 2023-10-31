<?php

namespace App\Interfaces;

interface PageRepositoryInterface
{
    public function getAllPages();
    public function getPageById($pageId);
    public function deletePage($pageId);
    public function deleteBulkPage($pageId);
    public function createPage(array $pageDetails);
    public function updatePage($pageId, array $newDetails);
}