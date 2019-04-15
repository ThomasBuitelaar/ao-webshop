@extends('layouts.app')

@section('content')
    <h1>Categories</h1>
    <ul>
        @foreach($categories as $category)
            <a href="/categories/{{$category->category_id}}"><li>{{$category->category_name}}</li></a>
        @endforeach
    </ul>
@endsection