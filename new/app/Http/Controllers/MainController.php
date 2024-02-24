<?php

namespace App\Http\Controllers;

use App\Models\to_do_list;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('welcome');
    }

    public function review()
    {
        return view('review');
    }

    //authorization

    public function authorization()
    {
        return view('authorization');
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
}
