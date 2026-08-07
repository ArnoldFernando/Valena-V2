<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('news.index', [
            'news' => News::orderByDesc('date')->paginate(8),
        ]);
    }

    public function show(News $news): View
    {
        return view('news.show', ['news' => $news]);
    }
}
