@extends('layouts.app')

@section('content')
    <div class="row justify-content-center m-0 p-0">
        <div style="width: 40rem;">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>{{ $article->title }}</h2>
                </div>
                <div class="card-img">
                    <img
                        src="{{ storage_image_url($article->image) }}"
                        alt="{{ $article->title }}"
                        class="img-fluid"
                    >
                </div>

                <div class="card-body">
                    <p>{{ $article->content }}</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <small class="text-muted text-capitalize">
                            {{ $article->created_at->isoFormat('LLL') }}
                        </small>
                        <small class="badge bg-primary align-content-end">
                            {{ $article->category->name }}
                        </small>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-2">
                        <a
                            href="{{ route('articles.edit', $article) }}"
                            class="btn btn-primary"
                        >
                            {{ __('Edit') }}
                        </a>
                        <form
                            action="{{ route('articles.destroy', $article) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="btn btn-danger"
                            >
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
