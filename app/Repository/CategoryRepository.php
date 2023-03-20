<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    public function getCategoriesPath(): array
    {
        return DB::table('categories as c1')
            ->select(DB::raw("c1.nombre || COALESCE(' -> ' || c2.nombre, '') || COALESCE(' -> ' || c3.nombre, '') AS path"))
            ->join('categories as c2', 'c1.id', '=', 'c2.idcategoriapadre')
            ->leftJoin('categories as c3', 'c2.id', '=', 'c3.idcategoriapadre')
            ->whereNull('c1.idcategoriapadre')
            ->pluck('path')
            ->toArray();
    }
}