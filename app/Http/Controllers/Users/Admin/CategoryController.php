<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::all();

        return \view('categories.index', \compact('categories'));
    }

    public function create()
    {
        return \view('categories.create');
    }

    public function store(Request $request)
    {
        $categroy = $this->validate($request, [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $categroy = new Category;
        $categroy->name_en = $request->name_en;
        $categroy->name_ar = $request->name_ar;

        $categroy->save();

        return \redirect(\route('category.index'));
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return \view('categories.edit', \compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = $this->validate($request, [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255'
        ]);

        $category = Category::find($id);
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;

        $category->save();

        return \redirect(\route('category.index'));

    }

    public function destroy($id)
    {
        $category = Category::find($id)->delete();

        return \redirect(\route('category.index'));
    }
}
