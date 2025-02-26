<?php

namespace App\Traits\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null): Model|null
    {
        $language = session(\App\Models\Base\Language::LOCALE_SESSION_KEY);

        return $this
            ->where($field . '->' . $language->language_code, $value)
            ->firstOr(function () use ($value, $field)
            {
                $defaultLanguage = Language::whereIsDefault(true)->first();

                return $this->where($field . '->' . $defaultLanguage->language_code, $value)->first();
            });
    }
}
