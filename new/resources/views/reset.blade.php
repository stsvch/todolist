@extends('layouts.layout')
@section('content')
    <div class="container">
            <form  method="post" action="{{route('authorization.reset.email')}}">
                @csrf
                    <h1 class="text-center">Reset</h1>
                    <div class="">
                        <input type="email" class="form-control" id="email" name ="email" placeholder="email">
                    </div>
                <button class="btn-create" type="submit">Reset</button>
            </form>
    </div>
@endsection
