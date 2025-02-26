<?php

namespace App\Models\Base;

use App\Traits\Models\HasSlug;
use App\Traits\Models\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasTranslations;
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    protected array $translatable = [
        'name',
        'slug',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'json',
            'slug' => 'json',
            'description' => 'json',
        ];
    }

    /**
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
        **/
}
