<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /*
     * The 7 Restful Controller Actions:
     * index, show, create, store, edit, update, destroy
     */

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Show a single resource.
     * Shows article with a given id.
     */
    public function show($id) {
        $article = $this->getArticleById($id);
        return view('articles.show', [
            'article' => $article
        ]);
    }

    protected function getArticleById($id) {
        // findOrFail($id) error handles, as opposed to just find($id).
        $article = Article::findOrFail($id);
        return $article;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Render a list of a resource.
     * Shows all articles.
     */
    public function index() {
        $articles = Article::latest()->get();
        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Shows a view to create a new resource.
     */
    public function create() {
        return view('articles.create');
    }

    /**
     * Persist the new resource.
     */
    public function store() {
        \request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => ['required'],
            'body' => ['required']
        ]);

        $article = new Article();
        $article->title = \request('title');
        $article->excerpt = \request('excerpt');
        $article->body = \request('body');
        $article->save();
        return redirect('/articles');
    }

    /**
     * Show a view to edit an existing resource.
     */
    public function edit($id) {
        $article = $this->getArticleById($id);
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * Persist the edited resource.
     */
    public function update($id) {
        \request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => ['required'],
            'body' => ['required']
        ]);

        $article = $this->getArticleById($id);
        $article->title = \request('title');
        $article->excerpt = \request('excerpt');
        $article->body = \request('body');
        $article->save();
        return redirect('/articles/' . $id);
    }

    /**
     * Delete the resource.
     */
    public function destroy() {

    }
}
