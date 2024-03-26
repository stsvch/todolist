@extends('layouts.layout')
@section('content')
<div class="center">
    <form method="post" action="{{route('add_task')}}">
        @csrf
        <h1 class="h3 mb-3 fw-normal text-center">Add task</h1>

        <div class="form-floating task">
            <input type="date" class="form-control" id="date" name="date" placeholder="Date">
            <label for="date">Date</label>
        </div>
        <div class="form-floating task text-center txt-area">
            <textarea id="text" name="text" rows="8" cols="45">
            </textarea>
        </div>
        <div class="form-floating task">
            <input type="text" class="form-control" id="title" name="title" placeholder="ToDo">
            <label for="title">To do</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Add</button>
    </form>
</div>
@endsection

