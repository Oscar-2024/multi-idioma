<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $timestamps = false;

    const LOCALE_SESSION_KEY = 'language';

    const SPANISH = [
        'name' => 'Spanish',
        'language_code' => 'es',
        'locale_code' => 'es_ES',
        'active' => true,
        'is_default' => true,
    ];

    const ENGLISH = [
        'name' => 'English',
        'language_code' => 'en',
        'locale_code' => 'en_US',
        'active' => true,
        'is_default' => false,
    ];

    const FRENCH = [
        'name' => 'French',
        'language_code' => 'fr',
        'locale_code' => 'fr_FR',
        'active' => true,
        'is_default' => false,
    ];

    const GERMAN = [
        'name' => 'German',
        'language_code' => 'de',
        'locale_code' => 'de_DE',
        'active' => true,
        'is_default' => false,
    ];
}
