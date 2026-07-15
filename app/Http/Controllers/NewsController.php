<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $news = News::with('country')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('country', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10);

        return view('news.index', compact('news', 'search'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('news.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id'   => 'required|exists:countries,id',
            'title'        => 'required',
            'source'       => 'required',
            'category'     => 'required',
            'published_at' => 'required|date',
            'description'  => 'required',
            'risk_level'   => 'required',
        ]);

        News::create($request->all());

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $countries = Country::orderBy('name')->get();

        return view('news.edit', compact('news', 'countries'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'country_id'   => 'required|exists:countries,id',
            'title'        => 'required',
            'source'       => 'required',
            'category'     => 'required',
            'published_at' => 'required|date',
            'description'  => 'required',
            'risk_level'   => 'required',
        ]);

        $news->update($request->all());

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Ambil berita dari GNews API
     */
    public function updateApi()
    {
        // Batasi dulu agar tidak cepat menghabiskan kuota GNews
        $countries = Country::limit(10)->get();

        foreach ($countries as $country) {

            $result = $this->newsService->search($country->name);
            dd($country->name, $result);

            if (!$result || !isset($result['articles'])) {
                continue;
            }

            foreach ($result['articles'] as $article) {

                News::updateOrCreate(

                    [
                        'title' => $article['title']
                    ],

                    [
                        'country_id'   => $country->id,
                        'title'        => $article['title'],
                        'description'  => $article['description'] ?? '',
                        'source'       => $article['source']['name'] ?? '',
                        'category'     => 'General',
                        'published_at' => $article['publishedAt'],
                        'risk_level'   => 'Medium'
                    ]

                );

            }

        }

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita berhasil diperbarui dari GNews API.');
    }
}