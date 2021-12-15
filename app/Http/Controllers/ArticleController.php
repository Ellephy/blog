<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index()
    {
        /* $data = Article::all();
        return view('articles/index', [
            'articles' => $data
        ]); */

        $data = Article::latest()->paginate(5);
        return view('articles.index', [
            'articles' => $data
        ]);
    }

    public function detail($id)
    {
        $data = Article::find($id);

        return view('articles.detail', [
            'article' => $data
        ]);
    }

    public function add()
    {
        $categories = [
            ["id" => 1, "name" => "News"],
            ["id" => 2, "name" => "Technology"]
        ];
        return view('articles.add', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article();
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->save();

        return redirect('/articles');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect('/articles')->with('info', 'The article is deleted.');
    }
}
