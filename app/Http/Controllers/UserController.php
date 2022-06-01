<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $users = \App\Models\User::paginate(10);
        $status = $request->get('status');
        // dd($users);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $users = \App\Models\User::where('email', 'like', "%$filterKeyword%")
                ->where('status', $status)
                ->paginate(10);
            if ($status) {
                $users = \App\Models\User::where('status', 'like', $status)->paginate(10);
                // }
            } else {
                // $users = \App\Models\User::paginate(10);
                $users = \App\Models\User::where('email', 'LIKE', "%$filterKeyword%")
                    ->paginate(10);
            }
        }
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
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
        $newUser = new \App\Models\User;
        $newUser->name = $request->get('name');
        $newUser->username = $request->get('username');
        $newUser->roles = json_encode($request->get('roles'));
        $newUser->name = $request->get('name');
        $newUser->address = $request->get('address');
        $newUser->phone = $request->get('phone');
        $newUser->email = $request->get('email');
        $newUser->password = Hash::make($request->get('password'));
        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');
            $newUser->avatar = $file;
        }
        $newUser->save();
        return redirect('users/create')->with('sukses', 'Data berhasil ditambahkan');
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
        $userShow = \App\Models\User::findOrFail($id);
        return view('users.show', ['userShow' => $userShow]);
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
        $user = \App\Models\User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = \App\Models\User::findOrFail($id);
        $user->name = $request->get('name');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->status = $request->get('status');
        if ($request->file('avatar')) {
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) { //jika ada file lama
                Storage::delete('public/' . $user->avatar);
            }
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }
        $user->save();
        return redirect()->route('users.edit', [$id])->with('status', 'User sucessfully updated');
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
        $userDelete = \App\Models\User::FindOrFail($id);
        $userDelete->delete();
        return redirect()->route('users.index')->with('status', 'User successfully deleted');
    }
}
