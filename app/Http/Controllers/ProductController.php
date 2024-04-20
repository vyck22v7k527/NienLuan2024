<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $category;
    public function __construct(category $category)
    {
        $this->category = $category;
    }
    public function index () {

        return view("admin.product.index");
    }

    public function create() {
        $category = $this->category::all();
        return view("admin.product.create", compact('category'));
    }
}
