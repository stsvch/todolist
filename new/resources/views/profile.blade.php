@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="form-block">
            <form  method="post" action="{{route('profile_add')}}">
                @csrf
                <div class="frm">
                    <h1>Create an account</h1>
                    <div class="inpt">
                        <input type="text" class="form-control" id="name" name ="name" placeholder="name">
                    </div>
                    <div class="inpt">
                        <input type="email" class="form-control" id="email" name ="email" placeholder="email">
                    </div>
                    <div class="inpt">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <button class="btn-create" type="submit">Create</button>
            </form>
        </div>
    </div>
@endsection


