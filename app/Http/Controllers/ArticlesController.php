<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    // Shows article with a given id.
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

    // Shows all articles
    public function index() {
        $articles = Article::latest()->get();
        return view('articles', [
            'articles' => $articles
        ]);
    }
}
