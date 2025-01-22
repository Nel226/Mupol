<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Articles',
                'url' => route('articles.index'),
                'active' => true
            ],
        
        ];
        $pageTitle = 'Articles';

        $articles = Article::all();


        return view('pages.backend.articles.index', [
            'articles' => $articles,
            'breadcrumbsItems' => $breadcrumbsItems,
            'pageTitle' => $pageTitle,

        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Articles',
                'url' => route('articles.index'),
                'active' => false
            ],
            [
                'name' => 'Nouvel article',
                'url' => route('articles.create'),
                'active' => true
            ],
        ];
        $pageTitle = 'Nouvel article';

        return view('pages.backend.articles.create', compact('pageTitle', 'breadcrumbsItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
