<div class="card p-1 shadow">
    <h2 class="text-center">{{ __($label) }}</h2>

    <nav>
        <div
            class="nav nav-tabs mb-3"
            id="nav-tab-{{ $name }}"
            role="tablist"
        >
            @foreach ($languages as $language)
                <button
                    class="nav-link {{ $loop->first ? 'active' : '' }}"
                    id="nav-{{ $language->language_code }}-{{ $name }}-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-{{ $language->language_code }}-{{ $name }}"
                    type="button"
                    role="tab"
                    aria-controls="nav-{{ $language->language_code }}-{{ $name }}"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                >
                    {{ __($language->name) }}
                </button>
            @endforeach
        </div>
    </nav>

    <div
        class="tab-content p-3 border bg-light"
        id="nav-tab-{{ $name }}"
    >
        @foreach ($languages as $language)
            <div
                class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                id="nav-{{ $language->language_code }}-{{ $name }}"
                role="tabpanel"
                aria-labelledby="nav-{{ $language->language_code }}-{{ $name }}-tab"
            >
                <div class="form-group mb-3">
                    @if ($type === 'text')
                        <input
                            type="text"
                            name="{{ $name }}_{{ $language->language_code }}"
                            class="form-control"
                            value="{{ old($name . '_' . $language->language_code, $values[$language->language_code] ?? '') }}"
                        />
                    @elseif ($type === 'textarea')
                        <textarea
                            name="{{ $name }}_{{ $language->language_code }}"
                            class="form-control">{{ old($name . '_' . $language->language_code, $values[$language->language_code] ?? '') }}</textarea>
                    @elseif ($type === 'file')
                        <input
                            type="file"
                            name="{{ $name }}_{{ $language->language_code }}"
                            class="form-control"
                        />
                    @endif
                    @error($name . '_' . $language->language_code)
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>
</div>
