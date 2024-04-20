<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $category;
    public function __construct(category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        if(auth()->check()) {
            auth()->user()->is_admin == 1 ? auth()->logout() : "";
        }
        $category = $this->category::all();

        return view('user.home', compact('category'));
    }

    public function detail(Request $request, $id)
    {
        $category = $this->category::all();

        $product = Product::find($id);

        return view('user.detail',  compact('category', 'product'));
    }
    
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Assuming $this->category is already defined in your class
        $category = $this->category::all();
        $page = "Kết quả tìm kiếm";

        // Use where() to perform a search on the 'name' column (change it to the actual column name)
        $products = Product::where('name', 'like', '%' . $searchTerm . '%')->get();

        return view('user.products', compact('category', 'products', 'page'));
    }

    public function products()
    {
        $category = $this->category::all();
        $page = "Tất cả sản phẩm";

        $products = Product::orderByDesc('created_at')->get();

        return view('user.products',  compact('category', 'products', 'page'));
    }

    public function productCategory(Request $request, $id)
    {
        $category = $this->category::all();
        $cat = $this->category::find($id);
        $page = $cat->name;
        if($cat !== null){
            $products = $cat->products;
        }

        return view('user.products',  compact('category', 'products', 'page'));
    }
}
