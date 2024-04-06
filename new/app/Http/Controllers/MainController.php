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
            return route('tasks');
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
                $response = new RedirectResponse(route('tasks'));
                $response->withCookie(cookie('user', $user->id, 30 * 24 * 60));
                return $response;
            }
            return redirect()->route('tasks');
        } else {
            $admin = Admin::where('name', $credentials['name'])
                ->where('password', $credentials['password'])
                ->first();
            if($admin) {
                session(['admin' => $admin->id]);
                if($remember) {
                    $response = new RedirectResponse(route('tasks'));
                    $response->withCookie(cookie('admin', $admin->id, 30 * 24 * 60));
                    return $response;
                }
                return redirect()->route('tasks');
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

    public function index(Request $request)
    {
        // Получаем список посещенных страниц из cookie
        $visitedPages = json_decode($request->cookie('visited_pages'), true) ?? [];

        return view('page5', ['visitedPages' => $visitedPages]);
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


}
