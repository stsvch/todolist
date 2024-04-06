<?php

namespace App\Http\Controllers;

use App\Models\to_do_list;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        if(session()->has('user')) {
            $user = session()->get('user');
            $list = to_do_list::where('userId', $user)
                ->get();
            return view('task',['list'=>$list, 'data'=>'tasks']);
        }else{
            return view('authorization')->with('error', 'Authorize');
        }
    }
    public function create()
    {
        return view('review');
    }

    public function delete($task)
    {
        $list = to_do_list::where('id', $task);
        $list->delete();
        if(session()->has('user')) {
            $user = session()->get('user');
            $list = to_do_list::find(to_do_list::findOrFail($user,'userId'));
            return view('task', ['list' => $list, 'data'=>'task']);
        }else{
            $list = to_do_list::all();
            return view('task', ['list' => $list, 'data'=>'task']);
        }
    }

    public function store(Request $request)
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
        return $this->index();
    }

    public function show($date)
    {
        if(session()->has('user')) {
            $user = session()->get('user');
            $list = to_do_list::where('date', $date)
                ->where('userId', $user)
                ->get();
            return view('task',['list'=>$list, 'data' =>'task'.$date]);
        }else{
            return view('authorization')->with('error', 'Authorize');
        }
    }

}
