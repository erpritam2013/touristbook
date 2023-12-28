<?php

namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Terms\Tag;
use DataTables;
class TagRepository implements TagRepositoryInterface 
{
    public function getAllTags() 
    {
        return Tag::orderBy('id','desc')->get();
    }
    public function getTagsByType($type=null,$tag_id=null) 
    {
        $tagTypeBuilder = [];

        $tagTypeBuilder = Tag::where('status', Tag::ACTIVE)->get(['id','name']);
        if (!empty($type)){
        $tagTypeBuilder = Tag::where('status', Tag::ACTIVE)->where('tag_type',$type)->get(['id','name']);
        }
        if (!empty($tag_id)){
        $tagTypeBuilder = Tag::where('status', Tag::ACTIVE)->where('id', '!=', $tag_id)->where('parent_id', '!=', $tag_id)->where('parent_id', 0)->get(['id','name']);
        }

       return $tagTypeBuilder;
    }

    public function getTagById($tagId) 
    {
        return Tag::findOrFail($tagId);
    }

    public function deleteTag($tagId) 
    {
        Tag::destroy($tagId);
    }
    public function deleteBulkTag($tagIds) 
    {
         Tag::whereIn('id', $tagIds)->delete();
    }

    public function createTag(array $tagDetails) 
    {
        return Tag::create($tagDetails);
    }

    public function updateTag($tagId, array $newDetails) 
    {
        return Tag::whereId($tagId)->update($newDetails);
    } 

    // Get all Active Tags or by Type
    public function getActiveTagsList($type = null) {
        $tagBuilder = Tag::where('status', Tag::ACTIVE);
        if($type)
            $tagBuilder->where('tag_type',$type);

        return $tagBuilder->get(['id','name']);
    }

    // Get Active Hotel Type Tags
    public function getActiveHotelTagsList() {
        $type = Tag::HOTEL_TYPE;
        // return $this->getActiveTagsList($type);
        return $this->getActiveTagsList($type);
    }
    // Get Active Loction Type Tags
    public function getActiveLocationTagsList() {
        $type = Tag::LOCATION_TYPE;
        // return $this->getActiveTagsList($type);
        return $this->getActiveTagsList($type);
    }
    // Get Active Post Type Tags
    public function getActivePostTagsList() {
        $type = Tag::POST_TYPE;

        // return $this->getActiveTagsList($type);
        return $this->getActiveTagsList($type);
    }
}
