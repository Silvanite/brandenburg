<?php

namespace Silvanite\Brandenburg\Controllers;

use Silvanite\Brandenburg\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::make($request->all());

        $user->password = bcrypt(str_random(12));
        $user->api_token = bcrypt(str_random(12));

        $user->save();

        if (is_numeric($roles = $request->roleids)) $roles = [$roles];

        if (is_array($roles)) 
            $user->setRolesById($roles);

        return 200;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
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
        $user = User::findOrFail($id);
        
        $user->update($request->all());
        
        if (is_numeric($roles = $request->roleids)) $roles = [$roles];

        if (is_array($roles)) 
            $user->setRolesById($roles);

        return 200;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return 200;
    }
}
