<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate();

        return view('article.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('article.show', compact('article'));
    }

    public function create()
    {
        $article = new Article();

        return view('article.create', compact('article'));
    }

    /**
    * Store a new article.
    *
    * @param  \app\Http\Requests\StoreArticleRequest $request
    * @return Illuminate\Http\Response
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

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

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

    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
        }
        return redirect()->route('articles.index');
    }
}
