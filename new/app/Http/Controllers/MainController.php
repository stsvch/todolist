<?php

namespace App\Http\Controllers;

use App\Models\to_do_list;
use App\Models\user;
use Illuminate\Http\Request;
use Session;

class MainController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function review()
    {
        return view('review');
    }

    public function authorization()
    {
        return view('authorization');
    }

    public function authorization_add(Request $request)
    {
        $valid = $request->validate([
            'name'=>"required|max:15",
            'password'=>'required|max:10',
            'email'=>'required|max:20'
        ]);
        $data = $request->all();
        user::create($data);
        return redirect()->route('home');
    }

    public function review_check(Request $request)
    {
        $valid = $request->validate([
            'title'=>"required",
            'date'=>'required|max:100'
        ]);
        $data = $request->all();
        to_do_list::create($data);
    }

    public function signin(Request $request)
    {
        $credentials = $request->only('name', 'password');
        $user = user::where('name', $credentials['name'])
            ->where('password', $credentials['password'])
            ->first();

        if ($user) {
            Session::put('user', $user);
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home')->with('error', 'Incorrect data');
        }

    }

    public function dashboard()
    {
        $user = Session::get('user');
        if ($user) {
            return view('dashboard', ['user' => $user]);
        } else {
            return redirect()->route('home');
        }
    }
}
