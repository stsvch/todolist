<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\to_do_list;
use App\Models\user;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Session;

class MainController
{
    public function home()
    {
        if(request()->hasCookie('user')) {
            session(['user' => request()->cookie('user')]);
        }else{
            session()->forget('user');
        }
        if(session()->has('user')) {
            return $this->show_all();
        } elseif(session()->has('admin')) {
            return $this->show_user_admin();
        } else {
            return view('authorization', ['error' => 'Authorize']);
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
        $remember = $request->has('remember');

        $user = User::where('name', $credentials['name'])
            ->where('password', $credentials['password'])
            ->first();

        if ($user) {
            session(['user' => $user->id]);
            if($remember) {
                $response = new RedirectResponse(route('home'));
                $response->withCookie(cookie('user', $user->id, 30 * 24 * 60));
                return $response;
            }
            return $this->show_all();
        } else {
            $admin = Admin::where('name', $credentials['name'])
                ->where('password', $credentials['password'])
                ->first();
            if($admin) {
                session(['admin' => $admin->id]);
                if($remember) {
                    $response = new RedirectResponse(route('home'));
                    $response->withCookie(cookie('admin', $admin->id, 30 * 24 * 60));
                    return $response;
                }
                return $this->show_user_admin();
            } else {
                return view('authorization', ['error' => 'Authorize']);
            }
        }
    }

    public function logout()
    {
        session()->forget('user');
        setcookie('user', "", time() - 3600, "/");
        session()->flush();
        return view('authorization');
    }

    public function logout_admin()
    {
        session()->forget('admin');
        setcookie('admin', "", time() - 3600, "/");
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
        $user = session()->get('user');
        $data = ([
            'title'=>$request->input('title'),
            'date'=>$request->input('date'),
            'text'=>$request->input('text'),
            'userId'=>$user
        ]);
        to_do_list::create($data);
        return $this->show_all();
    }

    public function task()
    {
        if (session()->has('user')) {
            return view('review');
        } else {
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function clndr()
    {
        if (session()->has('user')) {
            $user = session()->get('user');
            $list = to_do_list::where('userId', $user)->get();
            if($list){
                return view('calendar', ['list' => $list]);
            }else{
                return view('calendar', ['list' => []]);
            }

        } else {
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function show_date_task($date)
    {
        if(session()->has('user')) {
            $user = session()->get('user');
            $list = to_do_list::where('date', $date)
                ->where('userId', $user)
                ->get();
            return view('home',['list'=>$list, 'date'=>$date, 'data' =>'task']);
        }else{
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function show_task_admin()
    {
        if((session()->has('admin'))){
            $list = to_do_list::all();
            return view('home',['list'=>$list, 'date'=>'All task', 'data' =>'task']);
        }else{
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function show_user_admin()
    {
        if(session()->has('admin')){
            $list = user::all();
            return view('home',['list'=>$list, 'date'=>'All task', 'data' =>'user']);
        }else{
            return view('authorization')->with('error', 'Authorize');
        }
    }

    public function show_all()
    {
        if(session()->has('user')) {
            $user = session()->get('user');
            $list = to_do_list::where('userId', $user)
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
        if(session()->has('user')) {
            $user = session()->get('user');
            $list = to_do_list::find(to_do_list::findOrFail($user,'userId'));
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

    public function show_pages(Request  $request)
    {
        dd($request->cookie('pages'));
    }

    public function page1()
    {
        return view('page1');
    }

    public function page2()
    {
        return view('page2');
    }

    public function page3()
    {
        return view('page3');
    }

    public function page4()
    {
        return view('page4');
    }

    public function page5()
    {
        return view('page5');
    }


}
