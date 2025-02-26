<?php

namespace App\Models\Base;

use App\Traits\Models\HasSlug;
use App\Traits\Models\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasTranslations;
    use HasSlug;

    const STORAGE_PATH = 'articles';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'category_id',
    ];

    protected array $translatable = [
        'title',
        'slug',
        'content',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'json',
            'slug' => 'json',
            'content' => 'json',
            'image' => 'json',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
