<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Article;
use App\Cart
use App\Category;
use Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $articles = Article::orderBy('id', 'desc')->get();
        return view('articles.index')->with(compact('articles', 'categories'));
    } 
    
        
}
