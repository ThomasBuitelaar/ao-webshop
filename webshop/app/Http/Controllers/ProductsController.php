<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Storage;
use App\Product;
use App\Category;
use App\CategoryProduct;
use App\Cart;
class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'addToCart', 'getCart', 'removeOneCartItem', 'removeCartItems']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index')->with('products', $products);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        return view('products.create')->with('categories', $categories);
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
            'media' => 'image|required|max:20000',
            'category' => 'required',
            'specification-name_0' => 'required',
            'specification-value_0' => 'required'
        ]);
        //handle file upload
        if($request->hasFile('media')){
            $media = [];
            $filetype = 'image';
            $filenameWithExt = $request->file('media')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('media')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('media')->storeAs('public/product_images', $filenameToStore);
            // Check filetype
            //$filetype = mime_content_type($filenameToStore);
            if (strpos($filetype, 'image')) {
                $filetype = 'image';
            }
            else if (strpos($filetype, 'video')) {
                $filetype = 'video';
            }
            // Data to object
            $mediaObj = (object) [
                'alt' => $filename,
                'url' => $filenameToStore,
                'type' => $filetype
            ];
            array_push($media, $mediaObj);
            $media = json_encode($media);
        }
        // Handle specs
        $specRow = 0;
        $specsArray = [];
        foreach($request->input() as $key => $val) {
            if($key == 'specification-name_'.$specRow) {
                $specsArray[$val] = $request->input('specification-value_'.$specRow);
                $specRow++;
            }
        }
        $specificationsJson = json_encode($specsArray);
        // Create product
        $product = new Product;
        $product->product_name = $request->input('name');
        $product->product_price = $request->input('price');
        $product->product_discount_percentage = $request->input('discount-percentage');
        $product->product_description = $request->input('description');
        $product->product_media = $media;
        $product->product_specifications = $specificationsJson;
        $product->save();
        // Handle categories
        foreach($request->input('category') as $selectedCategory){
            $category = new CategoryProduct;
            $category->category_id_fk = $selectedCategory;
            $category->product_id_fk = $product->product_id;
            $category->save();
        }
        return redirect('/products')->with('success', 'Product Created');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $product = Product::find($id);
        $medias = json_decode($product->product_media); 
        $specifications = json_decode($product->product_specifications);
        return view('products.show')->with(['product' => $product, 'categories' => $categories, 'medias' => $medias, 'specifications' => $specifications]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $selectedOptionsArray = CategoryProduct::select('category_id_fk')->where('product_id_fk', $id)->get()->toArray();
        $product = Product::where('product_id', $id)->first();
        $medias = json_decode($product->product_media); 
        $specifications = json_decode($product->product_specifications);
        $options = [];
        $selectedOptions = [];
        foreach ($selectedOptionsArray as $selectedOption) {
            array_push($selectedOptions, $selectedOption['category_id_fk']);
        }
        foreach ($categories as $category) {
            $options[$category->category_id] = $category->category_name;
        }
        return view('products.edit')->with(['product' => $product, 'categories' => $categories, 'medias' => $medias, 'specifications' => $specifications, 'options' => $options, 'selectedOptions' => $selectedOptions]);
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'media' => 'image|max:20000',
            'category' => 'required',
            'specification-name_0' => 'required',
            'specification-value_0' => 'required'
        ]);
        //handle file upload
        if($request->hasFile('media')){
            $media = [];
            $filetype = 'image';
            $filenameWithExt = $request->file('media')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('media')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('media')->storeAs('public/product_images', $filenameToStore);
            // Check filetype
            //$filetype = mime_content_type($filenameToStore);
            if (strpos($filetype, 'image')) {
                $filetype = 'image';
            }
            else if (strpos($filetype, 'video')) {
                $filetype = 'video';
            }
            // Data to object
            $mediaObj = (object) [
                'alt' => $filename,
                'url' => $filenameToStore,
                'type' => $filetype
            ];
            array_push($media, $mediaObj);
            $media = json_encode($media);
        }
        // Handle specs
        $specRow = 0;
        $specsArray = [];
        foreach($request->input() as $key => $val) {
            if($key == 'specification-name_'.$specRow) {
                $specValue = $request->input('specification-value_'.$specRow);
                switch (strtolower($specValue)) {
                    case 'true':
                    case 'yes':
                        $specValue = true;
                        break;
                    case 'false':
                    case 'no':
                        $specValue = false;
                        break;
                    default:
                        //
                        break;
                }
                $specsArray[$val] = $specValue;
                $specRow++;
            }
        }
        $specificationsJson = json_encode($specsArray);
        // Update product
        $product = Product::find($id);
        $product->product_name = $request->input('name');
        $product->product_price = $request->input('price');
        $product->product_discount_percentage = $request->input('discount-percentage');
        $product->product_description = $request->input('description');
        if($request->hasFile('media')) {
            $product->product_media = $media;
        }
        $product->product_specifications = $specificationsJson;
        $product->save();
        //delete exsisting categories for this product
        $delCat = CategoryProduct::where('product_id_fk', $id)->delete();
        // Handle categories
        foreach($request->input('category') as $selectedCategory){
            $category = new CategoryProduct;
            $category->category_id_fk = $selectedCategory;
            $category->product_id_fk = $product->product_id;
            $category->save();
        }
        return redirect('/products')->with('success', 'Product Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $images = json_decode($product->product_media);
        foreach ($images as $image) {
            Storage::delete('public/product_images/'.$image->url);
        }
        $product->delete();
        return redirect('/')->with('success', 'Post Deleted');
    }
}