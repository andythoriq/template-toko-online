<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        // dd($request->validated());
        Category::create($request->validated());
        return redirect(route('category.index'))->with('success', 'berhasil menambah data category');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(CategoryStoreRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect(route('category.index'))->with('status', 'berhasil mengupdate data category');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect(route('category.index'))->with('status', 'berhasil menghapus data category');
    }
}