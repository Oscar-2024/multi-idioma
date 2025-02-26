<?php

namespace App\Actions\Articles;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

final class DestroyArticleAction
{
    public static function execute(Article $article): void
    {
        foreach ($article->getTranslations('image') as $key => $image)
        {
            Storage::disk('public')->delete($image);
        }

        $article->delete();
    }
}
