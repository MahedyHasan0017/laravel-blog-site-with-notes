<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser $request, User $user)
    {
        if($request->hasFile('avatar')){
            $link = $request->file('avatar')->store('public/avatars') ; 
            $path = str_replace('public', 'storage', $link);
            if($user->image){
                $user->image->path = $path ; 
                $user->image->save() ; 
            }
            else{

                // $image = new Image() ; 
                // $image->path = $path ; 
                // $image->save()  ; 

                $user->image()->save(
                    Image::make(['path' => $path]) 
                ); 
            }
        }

        return redirect()->route('users.show',['user' => $user->id]) ; 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        dd('delete');
    }
}
