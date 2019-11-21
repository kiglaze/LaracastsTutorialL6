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
        $article = Article::find($id);
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
}
