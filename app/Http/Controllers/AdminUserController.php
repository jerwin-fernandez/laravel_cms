<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\UserRequest;

use App\Http\Requests\UserEditRequest;

use App\User;

use App\Role;

use App\Photo;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id');

        return view('admin.users.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        if(trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = app('hash')->make($request->password);
        }

        // assign file
        if($file = $request->file('photo_id')) {

            // get the file name
            $name = time() . $file->getClientOriginalName();

            // move the file into directory
            $file->move(trim(Photo::$photo_dir, '/'), $name);


            $photo = Photo::create([
                'file' => $name,
            ]);

            // assign for ready persist
            $input['photo_id'] = $photo->id;
        }

        // insert all the data base on associative array
        User::create($input);

        return redirect('/admin/users');
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

        $user = User::find($id);

        $roles = Role::pluck('name', 'id');

        if(!$user) {
            return redirect('/admin/users');
        }

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if(trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = app('hash')->make($request->password);
        }

        if($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move(trim(Photo::$photo_dir, '/'), $name);

            $photo = Photo::create([
                'file' => $name
            ]);

            $input['photo_id'] = $photo->id;
        }

        $user->update($input);

        return redirect('/admin/users');

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
