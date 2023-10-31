<?php

namespace App\Repositories;

use App\Interfaces\PageRepositoryInterface;
use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    public function getAllPages()
    {
        return Page::orderBy('id','desc')->get();
    }
    public function getPageById($pageId)
    {
        return Page::findOrFail($pageId);
    }
    public function deletePage($pageId)
    {
        Page::destroy($pageId);
    }

    public function deleteBulkPage($pageId)
    {
         Page::whereIn('id', $pageId)->delete();
    }
    public function createPage(array $pageDetails)
    {
        return Page::create($pageDetails);
    }
    public function updatePage($pageId, array $newDetails)
    {
        return Page::whereId($pageId)->update($newDetails);
    }

}
