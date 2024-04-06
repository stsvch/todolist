@extends('layouts.layout')
@section('content')
    <h1>Посещенные страницы</h1>
    <ul>
        @foreach($visitedPages as $page => $timestamp)
            <li>{{ $page }} - {{ $timestamp }}</li>
        @endforeach
    </ul>
@endsection
