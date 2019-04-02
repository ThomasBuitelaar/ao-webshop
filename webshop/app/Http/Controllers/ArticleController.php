<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Article;
use App\Cart;
use App\Category;
use App\Order;
use App\Orderline;
use App\category_product;
use Auth;
use Session;

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
        //dd($articles[0]->imagePath);
        return view('articles.index')->with(compact('articles', 'categories'));
    } 
    
    public function articlesByCat($id)
    {
        $categories = Category::all();
        $category_name = Category::find($id);
        $articles = category_article::where('category_id', $id)->get();
        return view('articles.cat')->with(compact('articles', 'categories', 'category_name'));
        
}

public function create()
{
    $categories = Category::all();
    return view('articles.create')->with(compact('categories'));
}
/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */

public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'discount' => 'required',
        'imagePath' => 'image|nullable|max:1999'
    ]);
    if($request->hasFile('imagePath')){
        //save file
        $filenameWithExtension = $request->file('imagePath')->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $request->file('imagePath')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('imagePath')->storeAs('public/images', $fileNameToStore);
    }else{
        $fileNameToStore = 'noimage.jpg';
    }
    $article = new Article;
    $article->name = $request->name;
    $article->description = $request->description;
    $article->price = $request->price;
    $article->discount = $request->discount;
    $article->imagePath = $fileNameToStore;
    $article->save();
    foreach($request->categories as $category):
        $cat_prod = new category_article;
        $cat_prod->article_id = $article->id;
        $cat_prod->category_id = $category;
        $cat_prod->save();
    endforeach;
    return redirect('/articles');
}
/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */

public function show($id)
{
    $categories = Category::all();
    $article = Article::find($id);
    return view('articles.show')->with(compact('article', 'categories'));
}
/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */

public function edit($id)
{
    $categories = Category::all();
    $article = Article::find($id);
    return view('articles.edit')->with(compact('categories', 'article'));
}
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */

public function update(Request $request, $id)
{
    if($request->hasFile('imagePath')){
        //save file
        $filenameWithExtension = $request->file('imagePath')->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $request->file('imagePath')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('imagePath')->storeAs('public/images', $fileNameToStore);
    }else{
        $fileNameToStore = 'noimage.jpg';
    }
    $article = Article::find($id);
    $article->name = $request->name;
    $article->description = $request->description;
    $article->price = $request->price;
    $article->discount = $request->discount;
    $article->imagePath = $fileNameToStore;
    $article->save();
    $categories = category_article::where('article_id', $id)->get();
    foreach($request->categories as $category):
        $cat_prod = new category_article;
        $cat_prod->article_id = $article->id;
        $cat_prod->category_id = $category;
        $cat_prod->save();
    endforeach;
    return redirect('/articles');
}
/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */

public function destroy($id)
{
    $article = Article::find($id);
    $categories = category_article::where('article_id', $id)->get();
    foreach($categories as $category):
        $c_del = category_article::where('article_id', $category->article_id);
        $c_del->delete();
    endforeach;
    $article->delete();
    return redirect('/articles');
}

public function getAddToCart(Request $request, $id){
    $article = Article::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->add($article, $article->id);
    $request->session()->put('cart', $cart);
    return redirect('/articles');
}

public function removeOneFromShoppingCart($id)
{
    if(Session::has('cart')){
        $cart = Session::get('cart');
        $cart->totalPrice -= $cart->items[$id]['price'];
        $cart->totalQty -= 1;
        $cart->items[$id]['qty'] -= 1;
        if($cart->items[$id]['qty'] == 0){
            $this->deleteItemFromShoppingCart($id);
        }
        return redirect('/shopping-cart');
    }
}

public function addOneToShoppingCart(Request $request, $id)
{
    $article = Article::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->add($article, $article->id);
    $request->session()->put('cart', $cart);
    return redirect('/shopping-cart');
}

public function deleteItemFromShoppingCart($id)
{
    if(Session::has('cart')){
        $cart = Session::get('cart');
        $cart->totalPrice -= $cart->items[$id]['price'];
        $cart->totalQty -= $cart->items[$id]['qty'];
        unset($cart->items[$id]);
        if($cart->totalQty == 0){
            Session::forget('cart');
        }
        return redirect('/shopping-cart');
    }
}

public function getCart()
{
    $categories = Category::all();
    if(!Session::has('cart')){
       return view('shopping-cart.index')->with(['categories' => $categories]); 
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    return view('shopping-cart.index', ['' => $cart->items, 'totalPrice' => $cart->totalPrice, 'categories' => $categories]);
    
}
}
