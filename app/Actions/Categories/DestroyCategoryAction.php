<?php

namespace App\Actions\Categories;

use App\Models\Category;

final class DestroyCategoryAction
{
    public static function execute(Category $category): void
    {
        $category->delete();
    }
}
