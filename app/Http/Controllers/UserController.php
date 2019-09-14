<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['users'] = User::paginate(10);
        return view('admin.users.index', $data);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            return redirect()->route('admin.user.index')->with('message', " Add $user->name successful.");
        }
    }

    public function show($id)
    {
        $data['user'] = User::find($id);
        if ($data['user'] !== null) {
            return view('admin.users.show', $data);
        }
        return redirect()->route('admin.user.index')->with('error', 'Can not find this user.');
    }

    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'confirmed'
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $user = User::find($id);
            if ($user !== null) {
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                if ($request->input('password')) {
                    $user->password = bcrypt($request->input('password'));
                }
                $user->save();
                return redirect()->route('admin.user.index')->with('message', "Edit $user->name successful.");
            }

            return redirect()->route('admin.user.index')->with('error', "Can not find this user.");
        }

    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user !== null) {
            $user->delete();
            return redirect()->route('admin.user.index')->with('message', "Delete $user->name successful.");
        }
        return redirect()->route('admin.user.index')->with('error', 'Can not find this user.');
    }
}
