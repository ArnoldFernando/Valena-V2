<?php

namespace App\Http\Controllers\Admin;

use App\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('admin.news.index', [
            'news' => News::orderByDesc('date')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'intro_description' => ['required', 'string'],
            'full_description'  => ['required', 'string'],
            'date'              => ['required', 'date'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $data['news_number'] = (News::max('news_number') ?? 0) + 1;
        $data['image'] = $this->storeImage($request, 'image');

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'News article created.');
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', ['news' => $news]);
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $data = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'intro_description' => ['required', 'string'],
            'full_description'  => ['required', 'string'],
            'date'              => ['required', 'date'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $data['image'] = $this->replaceImage($request, 'image', $news->image);

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'News article updated.');
    }

    public function destroy(News $news): RedirectResponse
    {
        if ($news->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('images/' . $news->image);
        }
        $news->delete();

        return back()->with('success', 'News article deleted.');
    }
}
