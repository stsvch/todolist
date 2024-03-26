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
        if(Session::get('user')) {
            return $this->show_all();
        } else if(Session::get('admin')){
            return $this->show_user_admin();
        } else {
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function authorization()
    {
        return view('authorization');
    }

    public function profile()
    {
        return view('profile');
    }

    public function sign_in(Request $request)
    {
        $credentials = $request->only('name', 'password');
        $user = user::where('name', $credentials['name'])
            ->where('password', $credentials['password'])
            ->first();

        if ($user) {
            Session::put('user', $user);
            $list = to_do_list::where('userId', $user['id'])->get();
            if($list){
                return redirect()->route('home');
            }else{
                return redirect()->route('home');
            }
        } else {
            $admin = admin::where('name', $credentials['name'])
                ->where('password', $credentials['password'])
                ->first();
            if($admin) {
                Session::put('admin', $admin);
                return redirect()->route('home');
            }else{
                return view('authorization')->with('error', 'Authorize');
            }
        }
    }

    public function logout()
    {
        Session::forget('user');
        return view('authorization');
    }

    public function logout_admin()
    {
        Session::forget('admin');
        return view('authorization');
    }

    public function profile_add(Request $request)
    {
        $valid = $request->validate([
            'name'=>"required|max:15",
            'password'=>'required|max:10',
            'email'=>'required|max:20'
        ]);
        $data = $request->all();
        user::create($data);
        return view('authorization');
    }

    public function add_task(Request $request)
    {
        $valid = $request->validate([
            'title'=>"required",
            'date'=>'required|max:100'
        ]);
        $user = Session::get('user');
        $data = ([
            'title'=>$request->input('title'),
            'date'=>$request->input('date'),
            'text'=>$request->input('text'),
            'userId'=>$user['id']
        ]);
        to_do_list::create($data);
        $list = to_do_list::find(to_do_list::findOrFail($user['id'],'userId'));
       // return view('profile', ['list' => $list]);
    }

    public function task()
    {
        $user = Session::get('user');
        if ($user) {
            return view('review');
        } else {
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function clndr()
    {
        $user = Session::get('user');
        if ($user) {
            $list = to_do_list::where('userId', $user['id'])->get();
            if($list){
                return view('calendar', ['list' => $list]);
            }else{
                return view('calendar', ['list' => []]);
            }

        } else {
            return redirect()->route('authorization')->with('error', 'Authorize');
        }
    }

    public function show_date_task($date)
    {
        $user = Session::get('user');
        if($user) {
            $list = to_do_list::where('date', $date)
                ->where('userId', $user['id'])
                ->get();
            return view('home',['list'=>$list, 'date'=>$date, 'data' =>'task']);
        }else{
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function show_task_admin()
    {
        $admin = Session::get('admin');
        if($admin){
            $list = to_do_list::all();
            return view('home',['list'=>$list, 'date'=>'All task', 'data' =>'task']);
        }else{
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function show_user_admin()
    {
        $admin = Session::get('admin');
        if($admin){
            $list = user::all();
            return view('home',['list'=>$list, 'date'=>'All task', 'data' =>'user']);
        }else{
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function show_all()
    {
        $user = Session::get('user');
        if($user) {
            $list = to_do_list::where('userId', $user['id'])
                ->get();
            return view('home',['list'=>$list, 'date'=>'All my tasks', 'data'=>'task']);
        }else{
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function delete_task($listid)
    {
        $list = to_do_list::where('id', $listid);
        $list->delete();
        $user = Session::get('user');
        if($user) {
            $list = to_do_list::find(to_do_list::findOrFail($user['id'],'userId'));
            return view('home', ['list' => $list, 'date'=>'All my tasks', 'data'=>'task']);
        }else{
            $list = to_do_list::all();
            return view('home', ['list' => $list, 'date'=>'All users task', 'data'=>'task']);
        }
    }

    public function delete_user($listid)
    {
        $list = user::where('id', $listid);
        $list->delete();
        return $this->show_user_admin();
    }
}
