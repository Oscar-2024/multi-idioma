<?php

namespace App\Http\Controllers;

use App\Actions\Categories\DestroyCategoryAction;
use App\Actions\Categories\UpsertCategoryAction;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function create(): View
    {
        return view('categories.upsert', [
            'category' => new Category,
            'action' => route('categories.store'),
            'updating' => false,
            'availableLanguages' => available_languages(),
        ]);
    }

    public function store(CategoryRequest $categoryRequest): RedirectResponse
    {
        UpsertCategoryAction::execute(new Category, $categoryRequest->validated());

        session()->flash('status', 'success');
        session()->flash('message', __('Category created successfully'));

        return redirect()->route('home');
    }

    public function edit(Category $category): View
    {
        return view('categories.upsert', [
            'category' => $category,
            'action' => route('categories.update', $category),
            'updating' => true,
            'availableLanguages' => available_languages(),
        ]);
    }

    public function update(CategoryRequest $categoryRequest, Category $category): RedirectResponse
    {
        UpsertCategoryAction::execute($category, $categoryRequest->validated());

        session()->flash('status', 'success');
        session()->flash('message', __('Category updated successfully'));

        return redirect()->route('home');
    }

    public function destroy(Category $category): RedirectResponse
    {
        DestroyCategoryAction::execute($category);

        session()->flash('status', 'success');
        session()->flash('message', __('Category deleted successfully'));

        return redirect()->route('home');
    }
}
