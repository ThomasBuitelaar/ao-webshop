@extends('layouts.master', ['categories' => $categories])

@section('title')
    Ao Webshop - Categories
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
                <td><a href="#">{{$article->name}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection