@extends('layouts.layout')
@section('content')
<div class="center">
    <form method="post" action="{{route('review_check')}}">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Add</h1>

        <div class="form-floating">
            <input type="date" class="form-control" id="date" name="date" placeholder="Date">
            <label for="date">Date</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="title" name="title" placeholder="ToDo">
            <label for="title">To do</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Add</button>
    </form>
</div>
@endsection

