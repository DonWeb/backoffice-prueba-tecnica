<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function findProducts(?string $categoryId): array
    {
        $qb = DB::table('products')
            ->select('products.id', 'products.descripcion', 'products.precio', 'categories.nombre as categoria')
            ->join('categories','products.category_id', '=', 'categories.id');
        if(!empty($categoryId)){
            $qb->where('products.category_id', '=', $categoryId);
        }
        return $qb->get()->toArray();
    }
}

