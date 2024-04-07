@extends('layouts.layout')
@section('content')
    <div class="content-list">
        <div class="search-bar">
            <form action="{{route('tasks.find')}}" method="get">
                <input class="inpt-search" type="text" id="find" name="find" placeholder="Search" value="{{ request()->input('find') }}">
                <button type="submit">Search</button>
            </form>
        </div>
        <h1 class="text-center">{{$data}}</h1>
        @foreach($list as $task)
            <div class="card">
                <div class="card-header">
                    {{$task->date}}
                </div>
                <div class="card-body">
                    <div>
                        @php
                            $text = $task->text;
                            $arr = explode(" ", $text);
                            $res = "";
                            foreach ($arr as $str)
                            {
                                 if(preg_match('/[a-zA-Z0-9]+.[a-zA-Z0-]*@[a-zA-Z0-9]+.[a-zA-Z]+/', $str))
                                 {
                                     $str = "<span style='color: red;'>".$str."</span>";
                                 }else if($count = preg_match_all('/https?:\/\/[^?]+/', $str)){
                                    $pos = strpos($str, '?');
                                    if ($pos !== false) {
                                        $str = '<a title="' . $str . '"  style="color: green" href="' . $str . '">'
                                            . strstr($str, '?', true). '</a>';
                                    } else {
                                        $str = '<a title="' . $str . '" style="color: green" href="' . $str . '">'
                                            . $str . '</a>';
                                    }
                                 }else{

                                     $str = preg_replace_callback('/\d+/', function ($matches) {
                                            return '<span style="color: blue;">' . $matches[0] . '</span>';
                                            }, $str);
                                 }
                                 $res = $res." ".$str;
                            }
                            $res = preg_replace('/([a-zA-Z])\1{1}/','<span style="color: pink;">$0</span>', $res);
                        @endphp
                        {!! $res !!}
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        @if(session()->has('admin'))
                            @php
                                $user = \App\Models\user::find($task->userId);
                            @endphp
                            <h5 class="card-title">{{$user->name}}</h5>
                        @endif
                            <div class="d-flex justify-content-xl-end">
                                <form action='/tasks/{{$task->id}}' method="post" class="btn-form">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-check-circle-fill"
                                             viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    </button>
                                </form>
                                <form action='' method="post">
                                    @csrf
                                    <button type="button" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <style>
        .blue { color: blue; }
        .black { color: black; }
        .red { color: red; }
        .green { color: green;}
        .pink { color: pink;}
    </style>';
@endsection
