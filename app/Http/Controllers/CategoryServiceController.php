<?php

namespace App\Http\Controllers;

use App\Models\CategoryService;
use Illuminate\Http\Request;

class CategoryServiceController extends Controller
{

    public function index()
    {
        $categoryService = CategoryService::get();
        return view('admin.serviceCategoryIndex', compact('categoryService'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
        }
        // dd($image);

        $categoryService = new CategoryService;
        $categoryService->name = $request->get('name');
        $categoryService->image = $image;
        $categoryService->save();


        return redirect()->route('categoryService.index')
            ->with('success', 'New Category Service Added Succesfully');

    }


    public function show(CategoryService $categoryService)
    {
        //
    }


    public function edit(CategoryService $categoryService)
    {
        //
    }


    public function update(Request $request, CategoryService $categoryService)
    {
        //
    }


    public function destroy(CategoryService $categoryService)
    {

    }
}
