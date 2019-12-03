<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
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
    public function show(Article $article) {
//        $article = $this->getArticleById($id);
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
        $articles = null;
        if(\request('tag')) {
            $tagParam = \request('tag');
            $tag = Tag::where('name', $tagParam)->firstOrFail();
            $articles = $tag->articles;
        } else {
            $articles = Article::latest()->get();
        }
        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Shows a view to create a new resource.
     */
    public function create() {
        return view('articles.create', [
            'tags' => Tag::all()
        ]);
    }

    /**
     * Persist the new resource.
     */
    public function store() {
        $validatedAttrs = $this->validateForm();
//        $article = new Article();
//        $article->title = \request('title');
//        $article->excerpt = \request('excerpt');
//        $article->body = \request('body');
//        $article->save();

        /**
         * Will create article, assign attribute values, and save it in one go.
         * However, will need to set protected $fillable field for Article model class.
         *  This allows us to add "mass assignment".
         */
//        Article::create($validatedAttrs);

        $article = new Article(\request(['title', 'excerpt', 'body']));
        $article->user_id = 1; // temporary TODO make dynamic
        $article->save();

        if(\request()->has('tags')) {
            $article->tags()->attach(\request('tags'));
        }

        return redirect(route('articles.index'));
    }

    /**
     * Show a view to edit an existing resource.
     */
    public function edit(Article $article) {
//        $article = $this->getArticleById($id);
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * Persist the edited resource.
     */
    public function update(Article $article) {
        $validatedAttrs = $this->validateForm();

//        $article = $this->getArticleById($id);
        $id = $article->id;
//        $article->title = \request('title');
//        $article->excerpt = \request('excerpt');
//        $article->body = \request('body');
//        $article->save();
        $article->update($validatedAttrs);
        return redirect(route('articles.show', $id));
    }

    /**
     * Delete the resource.
     */
    public function destroy() {

    }

    /**
     * @return mixed
     */
    protected function validateForm()
    {
        $validatedAttrs = \request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'excerpt' => ['required'],
            'body' => ['required'],
            'tags' => ['exists:tags,id']
        ]);
        return $validatedAttrs;
    }
}
