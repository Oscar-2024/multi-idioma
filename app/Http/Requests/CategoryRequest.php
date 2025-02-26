<?php

namespace App\Http\Requests;

use App\Traits\Http\Requests\HasTranslations;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    use HasTranslations;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            ...$this->translatableRulesFor(
                field: 'name',
                rules: ['string', 'min:3', 'max:255'],
                table: 'categories',
                ignoredValue: request()->route('category')?->id,
                ignoredColum: 'id',
            ),
            ...$this->translatableRulesFor(
                field: 'description',
                rules: ['string', 'min:3', 'max:255'],
            ),
        ];
    }

    public function attributes(): array
    {
        return [
            ...$this->translatableAttributesFor(
                field: 'name',
                attribute: 'Name',
            ),
            ...$this->translatableAttributesFor(
                field: 'description',
                attribute: 'Description',
            ),
        ];
    }

    public function messages(): array
    {
        return [
            ...$this->translatableMessagesFor(
                field: 'name',
                rules: ['unique', 'string', 'min', 'max'],
            ),
            ...$this->translatableMessagesFor(
                field: 'description',
                rules: ['string', 'min', 'max'],
            ),
        ];
    }
}
