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
        $user = Session::get('user');
        if ($user) {
            return view('review');
        } else {
            return redirect()->route('home')->with('error', 'Authorize');
        }
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
        $user = Session::get('user');
        $data = ([
            'title'=>$request->input('title'),
            'date'=>$request->input('date'),
            'userId'=>$user['id']
            ]);
        to_do_list::create($data);
        $list = to_do_list::find(to_do_list::findOrFail($user['id'],'userId'));
        return view('profile', ['list' => $list]);
    }

    public function signin(Request $request)
    {
        $credentials = $request->only('name', 'password');
        $user = user::where('name', $credentials['name'])
            ->where('password', $credentials['password'])
            ->first();

        if ($user) {
            Session::put('user', $user);
            $list = to_do_list::find(to_do_list::findOrFail($user['id'],'userId'));
            return view('profile', ['list' => $list]);
        } else {
            return redirect()->route('home')->with('error', 'Authorize');
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
    public function profile()
    {
        $user = Session::get('user');
        if ($user) {
            $list = to_do_list::find(to_do_list::findOrFail($user['id'],'userId'));
            return view('profile', ['list' => $list]);
        } else {
            return redirect()->route('home')->with('error', 'Authorize');
        }
    }

    public function logout()
    {
        Session::forget('user');
        return view('home');
    }

    public function delete($listid)
    {
        $list = to_do_list::where('id', $listid);
        $list->delete();
        $user = Session::get('user');
        $list = to_do_list::find(to_do_list::findOrFail($user['id'],'userId'));
        return view('profile', ['list' => $list]);
    }
}
