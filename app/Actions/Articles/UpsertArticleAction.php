<?php

namespace App\Actions\Articles;

use App\Models\Article;
use App\Traits\Actions\HasTranslations;

final class UpsertArticleAction
{
    use HasTranslations;

    public static function execute(Article $article, array $validated): void
    {
        $article->category_id = data_get($validated, 'category_id');

        self::translationsStringFromRequestFor(
            model: $article,
            field: 'title',
            validated: $validated,
        );

        self::translationsStringFromRequestFor(
            model: $article,
            field: 'slug',
            validated: $validated,
            slugUsing: 'title',
        );

        self::translationsStringFromRequestFor(
            model: $article,
            field: 'content',
            validated: $validated,
        );

        self::translationsFileFromRequestFor(
            model: $article,
            field: 'image',
            disk: 'public',
            path: \App\Models\Base\Article::STORAGE_PATH,
            validated: $validated,
        );

        $article->save();
    }
}
