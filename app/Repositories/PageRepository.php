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

     public function forceDeletePage($pageId)
    {
         Page::onlyTrashed()->find($pageId)->forceDelete();
    }
    public function forceBulkDeletePage($pageId)
    {
         Page::onlyTrashed()->whereIn('id', $pageId)->forceDelete();
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

    public function getPageByType($pageId,$type)
    {
        if (!empty($pageId)) {
        return Page::whereId($pageId)->where('type',$type)->first();
        }else{
           return Page::where('type',$type)->get(['id','name']);
        }
    }

}
