@extends('layouts.layout')
@section('content')
    <form  method="post" action='/password/{{$token}}'>
        @csrf
        <div class="frm mt-5">
            <h1>Reset password</h1>
            <div class="inpt d-inline-grid">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <button class="" type="submit">New password</button>
            </div>
        </div>
    </form>
@endsection
