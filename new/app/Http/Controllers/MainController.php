<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\admin;
use App\Models\to_do_list;
use App\Models\user;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
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
            return view('authorization');
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
        $arr = $request->only('name', 'password');
        $remember = $request->has('remember');

        $user = User::where('name', $arr['name'])
            ->where('password', $arr['password'])
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
            $admin = Admin::where('name', $arr['name'])
                ->where('password', $arr['password'])
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
        $visitedPages = $request->cookie('pages');
        $visitedPages = explode(",", $visitedPages);
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

    public function reset()
    {
        return view('reset');
    }

    public function sendLink(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if($user)
        {
            $token = Str::random(64);
            $user->password_reset_token = $token;
            $user->save();
            try {
                Mail::to($request->input('email'))->send(new Email($user));
                return view('authorization')->with('status', 'Send');
            } catch (\Exception $e) {
                return view('authorization')->with('error', $e->getMessage());
            }
        }
        else{
            return view('authorization')->with('error', 'Email not found');
        }
    }

    public function showResetPasswordForm($token)
    {
        return view('password',['token'=>$token]);
    }

    public function updatePassword(Request $request, $token)
    {
        $validatedData = $request->validate([
            'password' => 'required|string',
        ]);
        $user = User::where('password_reset_token', $token)->first();

        if ($user) {
            $user->password = $validatedData['password'];
            $user->password_reset_token = null;
            $user->save();
            return view('authorization')->with('status', 'Password updated. Please log in.');
        } else {
            return view('authorization')->with('error', 'Invalid or expired token.');
        }
    }
}
