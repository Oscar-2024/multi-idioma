<form action="{{ $action }}" method="POST">
    @csrf

    @if($updating)
        @method('PUT')
    @endif

    <x-multi-lang-field
        type="text"
        name="name"
        label="Name"
        :languages="$availableLanguages"
        :values="$category->getTranslations('name')"
    />

    <x-multi-lang-field
        type="textarea"
        name="description"
        label="Description"
        :languages="$availableLanguages"
        :values="$category->getTranslations('description')"
    />

    <button type="submit" class="btn btn-primary mt-3">{{ __('Save') }}</button>
</form>
