<div class="d-flex justify-content-between align-items-center mb-2 ms-5">
    <h2>{{ __('Articles') }}</h2>
    <a
        href="{{ route('articles.create') }}"
        class="btn btn-primary"
    >
        {{ __('Create Article') }}
    </a>
</div>

@forelse ($articles as $article)
    <div class="card mb-4 ms-5">
        <div class="card-header">
            <a
                class="card-link text-dark text-decoration-none stretched-link h5"
                href="{{ route('articles.show', $article) }}"
            >
                {{ $article->title }}
            </a>
        </div>
        <div class="card-img">
            <a
                class="card-link text-dark text-decoration-none stretched-link h5"
                href="{{ route('articles.show', $article) }}"
            >
                <img
                    src="{{ storage_image_url($article->image) }}"
                    alt="{{ $article->title }}"
                    class="img-fluid"
                >
            </a>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <small class="text-muted">
                    {{ $article->created_at->isoFormat('LLL') }}
                </small>
                <small class="badge bg-primary align-content-center">
                    {{ $article->category->name }}
                </small>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-light" role="alert">
        {{ __('No :resource found', ['resource' => __('Articles')]) }}
    </div>
@endforelse

{{ $articles->links() }}
