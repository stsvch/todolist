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
                    <button class="btn-login" type="submit">login</button>
                </div>
            </form>
        </div>
        <form action="{{route('profile')}}" method="get">
            @csrf
            <button class="btn-create" type="submit">Create an account</button>
        </form>
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endsection
