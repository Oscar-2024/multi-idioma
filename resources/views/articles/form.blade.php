<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($updating)
        @method('PUT')
    @endif

    <div class="form-group mb-3">
        <label for="category_id">{{ __('Category') }}</label>
        <select name="category_id" id="category_id" class="form-control">
            <option value="">{{ __('Select a category') }}</option>
            @foreach (\App\Models\Category::all() as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <x-multi-lang-field
        type="text"
        name="title"
        label="Title"
        :languages="$availableLanguages"
        :values="$article->getTranslations('title')"
    />

    <x-multi-lang-field
        type="textarea"
        name="content"
        label="Content"
        :languages="$availableLanguages"
        :values="$article->getTranslations('content')"
    />

    <x-multi-lang-field
        type="file"
        name="image"
        label="Image"
        :languages="$availableLanguages"
    />

    <button type="submit" class="btn btn-primary mt-3">{{ __('Save') }}</button>
</form>
