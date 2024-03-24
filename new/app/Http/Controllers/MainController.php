<?php

namespace App\Http\Controllers;

use App\Models\admin;
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
            $list = to_do_list::where('userId', $user['id'])->get();
            if($list){
                return view('profile', ['list' => $list]);
            }else{
                return view('profile', ['list' => []]);
            }
        } else {
            $admin = admin::where('name', $credentials['name'])
                ->where('password', $credentials['password'])
                ->first();
            if($admin) {
                Session::put('admin', $admin);
                return redirect()->route('home');
            }else{
                return redirect()->route('home')->with('error', 'Authorize');
            }
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
            $list = to_do_list::where('userId', $user['id'])->get();
            if($list){
                return view('profile', ['list' => $list]);
            }else{
                return view('profile', ['list' => []]);
            }

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

    public function show($date)
    {
        $user = Session::get('user');
        if($user) {
            if ($date === 'all') {
                $list = to_do_list::where('userId', $user['id'])
                    ->get();
            } else {
                $list = to_do_list::where('date', $date)
                    ->where('userId', $user['id'])
                    ->get();
            }
        }else{
            $admin = Session::get('admin');
            $list = to_do_list::all();
        }
        return view('calendar',['list'=>$list, 'date'=>$date]);
    }
}
