<?php

namespace App\Http\Controllers;

use App\Actions\Articles\DestroyArticleAction;
use App\Actions\Articles\UpsertArticleAction;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function create(): View
    {
        return view('articles.upsert', [
            'article' => new Article(),
            'action' => route('articles.store'),
            'updating' => false,
            'availableLanguages' => available_languages(),
        ]);
    }

    public function store(ArticleRequest $articleRequest)
    {
        UpsertArticleAction::execute(new Article, $articleRequest->validated());

        session()->flash('status', 'success');
        session()->flash('message', __('Article created successfully'));

        return redirect()->route('home');
    }

    public function show(Article $article): View
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        return view('articles.upsert', [
            'article' => $article,
            'action' => route('articles.update', $article),
            'updating' => true,
            'availableLanguages' => available_languages(),
        ]);
    }

    public function update(ArticleRequest $articleRequest, Article $article)
    {
        UpsertArticleAction::execute($article, $articleRequest->validated());

        session()->flash('status', 'success');
        session()->flash('message', __('Article updated successfully'));

        return redirect()->route('home');
    }

    public function destroy(Article $article): RedirectResponse
    {
        DestroyArticleAction::execute($article);

        session()->flash('status', 'success');
        session()->flash('message', __('Article deleted successfully'));

        return redirect()->route('home');
    }
}
