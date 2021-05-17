<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\CategoryService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()
    {
        $service = Service::with('categoryService')->get();
        $categoryService = CategoryService::all();
        return view('admin.service', compact('service', 'categoryService'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_service_id' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
        }

        $service = new Service;
        $service->name = $request->get('name');
        $service->price = $request->get('price');
        $service->image = $image;

        $categoryService = new CategoryService;
        $categoryService->category_service_id = $request->get('category_service_id');

        $service->categoryService()->associate($categoryService);
        $service->save();


        return redirect()->route('service.index')
            ->with('success', 'Service Successfully Added');
    }

    
    public function show(Service $service)
    {
        //
    }

    
    public function edit(Service $service)
    {
        //
    }

    
    public function update(Request $request, Service $service)
    {
        //
    }

   
    public function destroy(Service $service)
    {
        //
    }
}
