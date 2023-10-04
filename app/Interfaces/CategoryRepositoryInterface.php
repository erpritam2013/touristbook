<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface 
{
    public function getAllCategories();
    public function getCategoryById($categoryId);
    public function deleteCategory($categoryId);
    public function deleteBulkCategory($categoryIds);
    public function createCategory(array $categoryDetails);
    public function updateCategory($categoryId, array $newDetails);
    public function getCategoriesByType(string $type);

    public function getActiveCategoriesList($type);
    public function getActivePostCategoriesList();
    
}