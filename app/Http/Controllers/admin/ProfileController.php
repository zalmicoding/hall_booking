<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Footer_info;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $copy_right = Footer_info::value('copyRight');

        return response()->view('admin.profile', compact('copy_right'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'file', 'max:2048'],
            'name' => ['required', 'string'],
            'contact_number' => ['required', 'numeric', 'digits_between:11,15'],
            'address' => ['required', 'max:255'],
            'description' => ['required', 'max:255']
        ]);

        $logged_id =  Auth::user()->id;

        User::where('id', $logged_id)->update([
            'name' => $request['name'],
        ]);

        if (empty($request->hasFile('avatar')) && $request['avatar'] == null) {
            $avatar_name = $request->user()->profile->avatar;
        }
        else
        {
            $file = $request->file('avatar');

            $avatar_name = $file->hashName();

            $file->move(public_path('storage/profile_img'), $avatar_name);
        }


        Profile::updateOrCreate([
            'user_id' => $logged_id,
        ],
        [
            'avatar' => $avatar_name,
            'contact' => $request['contact_number'],
            'address' => $request['address'],
            'description' => $request['description'],
        ]);

        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pass_update(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'confirmed']
        ]);

        $logged_password = Auth::user()->password;

        $logged_id =  Auth::user()->id;


        if(!Hash::check($request['old_password'], $logged_password))
            return redirect()->route('admin.profile')
            ->with('error_password', 'Old password does not match!');

        User::where('id', $logged_id)->update([
            'password' => Hash::make($request['new_password']),
        ]);

        Auth::logout();

        return response()->view('front_view.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
