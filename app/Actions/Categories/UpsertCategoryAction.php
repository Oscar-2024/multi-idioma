<?php

namespace App\Actions\Categories;

use App\Models\Category;
use App\Traits\Actions\HasTranslations;

final class UpsertCategoryAction
{
    use HasTranslations;

    public static function execute(Category $category, array $validated): void
    {
        self::translationsStringFromRequestFor(
            model: $category,
            field: 'name',
            validated: $validated,
        );

        self::translationsStringFromRequestFor(
            model: $category,
            field: 'slug',
            validated: $validated,
            slugUsing: 'name',
        );

        self::translationsStringFromRequestFor(
            model: $category,
            field: 'description',
            validated: $validated,
        );

        $category->save();
    }
}
