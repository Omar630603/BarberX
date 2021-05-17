<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        

    }

    
    public function edit($service_id)
    {
        $service = Service::where('service_id', $service_id)
            ->first();
        $categoryService = CategoryService::all();
        return view('admin.serviceEdit', ['service' => $service, 'categoryService' => $categoryService]);
    }

    
    public function update(Request $request, $idservice)
    {
        $request->validate([
            'name' => 'required',
            'category_service_id' => 'required',
            'price' => 'required',
            'image' => 'nullable',
        ]);

        $service = Service::where('service_id', $idservice)
            ->first();

        if ($request->file('image')) {
            if ($service->image && file_exists(storage_path('app/public/' . $service->image))) {
                Storage::delete('public/' . $service->image);
                $image = $request->file('image')->store('images', 'public');
                $service->image = $image;
            }
        }

        $service->name = $request->get('name');
        $service->price = $request->get('price');

        $categoryService = new CategoryService;
        $categoryService->category_service_id = $request->get('category_service_id');

        $service->categoryService()->associate($categoryService);
        $service->save();


        return redirect()->route('service.index')
            ->with('success', 'Service Successfully Updated');


    }

   
    public function destroy(Service $service)
    {
        //
    }
}
