<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Terms\Category;

class CategoryRepository implements CategoryRepositoryInterface 
{
    public function getAllCategories()
    {
        return Category::orderBy('id','desc')->get();
    }
    public function getCategoriesByType($type=null,$cat_id=null) 
    {
        $categoryTypeBuilder = [];
        if (!empty($type)){
        $categoryTypeBuilder = Category::where('status', Category::ACTIVE)->where('category_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($cat_id)){
        $categoryTypeBuilder = Category::where('status', Category::ACTIVE)->where('id', '!=', $cat_id)->where('parent_id', '!=', $cat_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $categoryTypeBuilder;
    }

    public function getCategoryById($categoryId) 
    {
        return Category::findOrFail($categoryId);
    }

    public function deleteCategory($categoryId) 
    {
        Category::destroy($categoryId);
    }
    public function deleteBulkCategory($categoryIds) 
    {
        Category::whereIn('id', $categoryIds)->delete();
    }

    public function createCategory(array $categoryDetails) 
    {
        return Category::create($categoryDetails);
    }

    public function updateCategory($categoryId, array $newDetails) 
    {
        return Category::whereId($categoryId)->update($newDetails);
    } 



    // Get all Active Categories or by Type
    public function getActiveCategoriesList($type = null) {
        $categoryBuilder = Category::orderBy('name','asc')->where('status', Category::ACTIVE);

        if($type)
            $categoryBuilder->where('category_type',$type);

        $categories = $categoryBuilder->latest()->get(['id','name', 'parent_id']);

        $nestedResult = $categories->toNested();

        return  $nestedResult;
    }

    // Get Active Hotel Type Categories
    public function getActivePostCategoriesList() {
        $type = Category::POST_TYPE;
        return $this->getActiveCategoriesList($type);
    }
}
