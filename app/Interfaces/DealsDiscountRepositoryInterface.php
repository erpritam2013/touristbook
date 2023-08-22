<?php

namespace App\Interfaces;

interface DealsDiscountRepositoryInterface 
{
    public function getAllDealsDiscounts();
    public function getDealsDiscountById($dealsDiscountId);
    public function deleteDealsDiscount($dealsDiscountId);
    public function deleteBulkDealsDiscount($dealsDiscountIds);
    public function createDealsDiscount(array $dealsDiscountDetails);
    public function updateDealsDiscount($dealsDiscountId, array $newDetails);
    public function getDealsDiscountsByType(string $type);

    public function getActiveDealsDiscountsList($type);
    public function getActiveHotelDealsDiscountsList();
}
