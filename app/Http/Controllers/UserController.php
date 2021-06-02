<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $admins = User::search(['name', 'email'], $search)->get();
        } else {
            $admins = User::get();
        }
        return view('admin.adminIndex', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function profile($iduser)
    {
        // $idUser = Auth::User->user_id;
        $user = User::where('user_id', $iduser)->first();
        return view('admin.profile', compact('user'));
    }

    public function updateImage(Request $request, $iduser)
    {
        $request->validate([
            'image' => 'required',
        ]);
        $user = User::where('user_id', $iduser)->first();
        if ($request->file('image')) {
            Storage::delete('public/' . $user->image);
            $image = $request->file('image')->store('images', 'public');
            $user->image = $image;
        }

        $user->save();
        return redirect()->route('user.profile', $iduser)
            ->with('success', 'Profile Photo updated');
    }

    public function updateBio(Request $request, $iduser)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('user_id', $iduser)->first();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return redirect()->route('user.profile', $iduser)
            ->with('success', 'Profile Photo updated');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $admin = new User;
        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
            $admin->image = $image;
        }

        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->password =  Hash::make($request->get('password'));
        $admin->save();


        return redirect()->route('admins.index')
            ->with('success', 'New Admin Added Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('admin.adminEdit', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'nullable',

        ]);
        if ($request->file('image')) {
            if ($admin->image) {
                Storage::delete('public/' . $admin->image);
            }
            $image = $request->file('image')->store('images', 'public');
            $admin->image = $image;
        }

        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->save();

        return redirect()->route('admins.index')
            ->with('success', 'Admin seccesfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        Storage::delete('public/' . $admin->image);
        $admin->delete();
        return redirect()->route('admins.index')
            ->with('success', 'Admin seccesfully Deleted');
    }
}
