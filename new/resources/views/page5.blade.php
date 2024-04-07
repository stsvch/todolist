@extends('layouts.layout')
@section('content')
    <h1>Посещенные страницы</h1>
    <ul>
        @foreach($visitedPages as $page)
            <li>{{ $page }}</li>
        @endforeach
    </ul>
@endsection
