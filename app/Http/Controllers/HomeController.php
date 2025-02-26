<?php

namespace App\Http\Controllers;

//use App\Models\Article;
use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        //$articles = Article::with('category')->paginate(10);
        $categories = Category::withCount('articles')->get();

        return view('home', compact('articles', 'categories'));
    }
}
