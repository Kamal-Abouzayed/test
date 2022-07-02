<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);

        $this->middleware('auth:admin');
    }

    public function index()
    {
        $products = Product::all();

        return \view('products.index', \compact('products'));
    }

    public function create()
    {
        $categories = Category::get()->all();

        return \view('products.create', \compact('categories'));
    }

    public function store(Request $request)
    {
        $product = $this->validate($request, [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product = new Product;
        $product->name_en = $request->name_en;
        $product->name_ar = $request->name_ar;
        $product->category_id = $request->category;

        if ($request->hasFile('image')) {
            $imageName = \time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
        }

        $product->image = $imageName;


        $product->save();

        return \redirect(\route('product.index'));

    }

    public function edit($id)
    {
        $product = Product::find($id);

        $categories = Category::get()->all();

        return \view('products.edit', \compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        $product = $this->validate($request, [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            // 'category' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product = Product::find($id);
        $product->name_en = $request->name_en;
        $product->name_ar = $request->name_ar;
        $product->category_id = $request->category;

        if ($request->hasFile('image')) {
            $imageName = \time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
        }

        // $product->image = $imageName;



        $product->update();

        return \redirect(\route('product.index'));

    }

    public function destroy($id)
    {
        $product = Product::find($id)->delete();

        return \redirect(\route('product.index'));
    }
}
