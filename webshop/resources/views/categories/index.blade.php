@extends('layouts.master', ['categories' => $categories])

@section('title')
    Ao Shopping Cart - Categories
@endsection

@section('content')
    <h1>All Categories</h1>

    <table class='table'>
        <thead class='thread-dark'>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>Name</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection