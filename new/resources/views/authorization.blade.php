@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="form-block">
            <form action="{{route('sign_in')}}" method="post">
                @csrf
                <div class="frm">
                    <h1>Login</h1>
                    <div class="inpt">
                        <input type="text" class="form-control" id="name" name ="name" placeholder="Name">
                    </div>
                    <div class="inpt">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="inpt">
                        <input type="checkbox" name="remember"> Remember Me
                    </div>
                    <div class="inpt">
                    <button class="btn-login" type="submit">login</button>
                    </div>
                </div>
            </form>
        </div>
        <form action="{{route('profile')}}" method="get">
            @csrf
            <div class="inpt">
                <button class="btn-create" type="submit">Create an account</button>
            </div>
        </form>
        <form action="{{route('authorization.reset')}}" method="get">
            @csrf
            <div class="inpt">
                <a href="/authorization/reset" class="text-center">Forgot password</a>
            </div>
        </form>
        @if((isset($error)))
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endif
        @if((isset($status)))
            <div class="alert alert-success" role="alert">
                {{$status}}
            </div>
        @endif
    </div>
@endsection
