<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Service;
use App\Models\CategoryService;
use App\Models\Employee;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $msg = Message::where('show', 1)->get();
        $employee = Employee::get();
        $service = Service::get();
        $serviceCategory = CategoryService::get();
        dd($serviceCategory);
        return view('home', compact('msg', 'employee', 'service', 'serviceCategory'));
    }
}
