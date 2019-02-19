@extends('layouts.master', ['categories' => $categories])

@section('title')
    Ao Webshop - Categories
@endsection

@section('content')
    <h1>All Categories</h1>

    <table class='table'>
        <thead class='thread-dark'>
            <tr>
                <th scope='col'>Categorie</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $article)
            <tr>
                <td><a href="/categories/{{$article->id}}">{{$article->name}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection