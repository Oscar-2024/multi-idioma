<div class="card">
    <div class="card-header">{{ __('Categories') }}</div>
    <div class="card-body">
        <ul class="list-group list-group-light">
            @forelse($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            {{ $category->name }} ({{ $category->articles_count }})
                        </div>
                    </div>

                    <div>
                        <a
                            href="{{ route('categories.edit', $category) }}"
                            class="btn btn-sm btn-primary"
                        >
                            {{ __('Edit') }}
                        </a>

                        <form
                            class="d-inline"
                            action="{{ route('categories.destroy', $category) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                            >
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="list-group list-group-item">
                    {{ __('No :resource found', ['resource' => __('Categories')]) }}
                </li>
            @endforelse
        </ul>
    </div>

    <!-- create category -->
    <div class="card-footer">
        <a
            href="{{ route('categories.create') }}"
            class="btn btn-primary"
        >
            {{ __('Create Category') }}
        </a>
    </div>
</div>
