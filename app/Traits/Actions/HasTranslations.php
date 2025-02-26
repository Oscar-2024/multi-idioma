<?php

namespace App\Traits\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasTranslations
{
    public static function translationsStringFromRequestFor(
        Model $model,
        string $field,
        array $validated,
        string $slugUsing = null,
    ): void
    {
        foreach (available_languages() as $language)
        {
            $languageCode = $language->language_code;

            if ($slugUsing)
            {
                if ($slugValue = $validated[$slugUsing . '_' . $languageCode])
                {
                    $model->setTranslation(
                        $field,
                        Str::slug($slugValue),
                        $languageCode,
                    );
                }

                continue;
            }

            if ($value = $validated[$field . '_' . $languageCode])
            {
                $model->setTranslation(
                    $field,
                    $value,
                    $languageCode,
                );

                continue;
            }

            $model->forgetTranslation($field, $languageCode);
        }
    }

    public static function translationsFileFromRequestFor(
        Model $model,
        string $field,
        string $disk,
        string $path,
        array $validated,
    ): void
    {
        foreach (available_languages() as $language)
        {
            $languageCode = $language->language_code;

            if (array_key_exists($field . '_' . $languageCode, $validated))
            {
                if ($previousFile = $model->getTranslation($field, $languageCode, false))
                {
                    Storage::disk($disk)->delete($previousFile);
                }

                $uploadedFile = $validated[$field . '_' . $languageCode];
                $fileName = $uploadedFile->store($path, $disk);

                $model->setTranslation(
                    $field,
                    $fileName,
                    $languageCode,
                );
            }
        }
    }
}
