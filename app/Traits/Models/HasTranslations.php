<?php

namespace App\Traits\Models;

trait HasTranslations
{
    // get the translation for a given key in the current locale
    //for example for the title attribute for spanish locale
    public function getAttribute($key): mixed
    {
        return match (true) {
            method_exists($this, $key),
            ! isset($this->translatable),
            ! in_array($key, $this->translatable) => parent::getAttribute($key),
            default => $this->getTranslation($key),
        };
    }

    // get the translation for a given key in a given locale
    public function getTranslation(string $key, string $locale = null, bool $withDefault = true): mixed
    {
        $translations = (array) $this->getTranslations($key);

        return data_get(
            target: $translations,
            key: $locale ?? app()->getLocale(),
            default: $withDefault ? $translations[app()->getFallbackLocale()] : null,
        );
    }

    // get all translations for a given key
    // for example for the title attribute on spanish locale
    public function getTranslations(string $key): ?array
    {
        return parent::getAttribute($key);
    }

    // set the translation for a given key in the current locale
    public function setAttribute($key, $value): static
    {
        return match (true) {
            method_exists($this, $key),
            !isset($this->translatable),
            !in_array($key, $this->translatable) => parent::setAttribute($key, $value),
            default => is_array($value)
                ? $this->setTranslations($key, $value)
                : $this->setTranslation($key, $value),
        };
    }

    // set the translation for a given key in a given locale
    public function setTranslation(string $key, string $value, string $locale = null): static
    {
        $translations = (array) $this->getTranslations($key);

        $translations[$locale ?? app()->getLocale()] = $value;

        return parent::setAttribute($key, $translations);
    }

    // set all translations for a given key
    public function setTranslations(string $key, array $translations): static
    {
        foreach ($translations as $locale => $value)
        {
            $this->setTranslation($key, $value, $locale);
        }

        return parent::setAttribute($key, $translations);
    }

    // forget the translation for a given key in the current locale
    public function forgetTranslation(string $key, string $locale): static
    {
        $translations = (array) $this->getTranslations($key);

        unset($translations[$locale]);

        return parent::setAttribute($key, $translations);
    }
}
