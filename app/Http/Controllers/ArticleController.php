<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate();

        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new Article();

        return view('article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\StoreArticleRequest $request)
    {
        $validated = $request->validated();
        
        $data = $this->validate($request, [
            'name' => 'required|unique:articles',
        ]);

        $article = new Article();

        $article->fill($validated);
        $article->fill($data);
        $article->save();

        return redirect()
            ->route('articles.index')->with('success', 'Article was added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\StoreArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validated();

        $data = $this->validate($request, [
            'name' => 'required|unique:articles,name,' . $article->id,
        ]);

        $article->fill($data);
        $article->fill($validated);
        $article->save();
        return redirect()
            ->route('articles.index')->with('success', 'Article was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if ($article) {
            $article->delete();
        }
        return redirect()->route('articles.index');
    }
}
