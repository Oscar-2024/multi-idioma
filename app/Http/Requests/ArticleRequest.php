<?php

namespace App\Http\Requests;

use App\Traits\Http\Requests\HasTranslations;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    use HasTranslations;

    public function authorize(): bool
    {
        return true;
    }

    public function isUpdating(): bool
    {
        return $this->routeIs('articles.update');
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required'],
            ...$this->translatableRulesFor(
                field: 'title',
                rules: ['string', 'min:3', 'max:255'],
                table: 'articles',
                ignoredValue: request()->route('article')?->id,
                ignoredColum: 'id',
            ),
            ...$this->translatableRulesFor(
                field: 'content',
                rules: ['string', 'min:3'],
            ),
            ...$this->translatableRulesFor(
                field: 'image',
                rules: ['image', 'max:1024'],
                requireDefault: ! $this->isUpdating(),
            ),
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => __('Category'),
            ...$this->translatableAttributesFor(
                field: 'title',
                attribute: 'Title',
            ),
            ...$this->translatableAttributesFor(
                field: 'content',
                attribute: 'Content',
            ),
            ...$this->translatableAttributesFor(
                field: 'image',
                attribute: 'Image',
            ),
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => __('validation.required'),
            ...$this->translatableMessagesFor(
                field: 'title',
                rules: ['unique', 'string', 'min', 'max'],
            ),
            ...$this->translatableMessagesFor(
                field: 'content',
                rules: ['string', 'min'],
            ),
            ...$this->translatableMessagesFor(
                field: 'image',
                rules: ['image', 'max'],
            ),
        ];
    }
}
