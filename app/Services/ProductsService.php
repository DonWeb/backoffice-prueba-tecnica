<?php

namespace App\Services;

use App\Models\Product;

class ProductsService
{
    public function getByCategory($category)
    {

        return ($category)
            ? Product::where('category_id', $category)->get()
            : Product::all();
    }
}
