<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class UserManagementController extends Controller
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
        $users = user::all();
        $role= Role::all();
        Session::put('menu','user');
        return view('usermanagement.user',compact('users','role'));
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'password' => 'required',
            'nama_user' => 'required',
            'role' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $user = new user;
        $user->id = $request->id;
        $user->nama_user = $request->nama_user;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect('usermanagement')
        ->with('success','New data user successfully added!');

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required|unique:users|max:255',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $user = user::find($id);
        $user->nama_user = $request->nama_user;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect('usermanagement')
        ->with('success','Data user successfully updated!');
    }

    public function delete($id)
    {
        user::find($id)->delete();
         return redirect('usermanagement')
         ->with('success','Data user successfully deleted!');
    }
}
