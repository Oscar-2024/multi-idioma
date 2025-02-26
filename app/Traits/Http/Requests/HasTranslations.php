<?php

namespace App\Traits\Http\Requests;

use Illuminate\Validation\Rule;

trait HasTranslations
{
    public function translatableRulesFor(
        string $field,
        array $rules,
        string $table = null,
        int $ignoredValue = null,
        string $ignoredColum = null,
        bool $requireDefault = true,
    ): array
    {
        $validationRules = [];

        foreach (available_languages() as $language)
        {
            $validationRules[$field . '_' . $language->language_code] = $rules;

            if (! in_array('required', $rules))
            {
                $validationRules[$field . '_' . $language->language_code][] = $language->is_default && $requireDefault ?
                    'required' :
                    'nullable';
            }

            if ($table && $ignoredColum)
            {
                $validationRules[$field . '_' . $language->language_code][] = Rule::unique($table, $field . '->' . $language->language_code)->ignore($ignoredValue, $ignoredColum);
            }
        }

        return $validationRules;
    }

    public function translatableAttributesFor(string $field, string $attribute): array
    {
        $validationAttributes = [];

        foreach (available_languages() as $language)
        {
            $validationAttributes[$field . '_' . $language->language_code] = __($attribute) . ' (' . __($language->name) . ')';
        }

        return $validationAttributes;
    }

    public function translatableMessagesFor(string $field, array $rules = []): array
    {
        $validationMessages = [];

        foreach (available_languages() as $language)
        {
            foreach ($rules as $rule)
            {
                $validationMessages[$field . '_' . $language->language_code . '.' . $rule] = __('validation.' . $rule);
            }
        }

        return $validationMessages;
    }
}
