<?php

namespace Tests\Feature;

use App\Repository\CategoryRepository;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    
    public function testGetCategoriesPath()
    {
        $expected = [ 
            'Indumentaria -> Adidas',
            'Indumentaria -> Nike',
            'Calzado -> Calzado Dita',
            'Calzado -> Calzado Nike',
            'Calzado -> Calzado Adidas',
            'Calzado -> Running -> Adidas',
            'Calzado -> Running -> Puma',
            'Calzado -> Crocs' 
        ];
        $categoryRepository = new CategoryRepository();
        $result = $categoryRepository->getCategoriesPath();
        $this->assertEquals($expected, $result);
    }
}