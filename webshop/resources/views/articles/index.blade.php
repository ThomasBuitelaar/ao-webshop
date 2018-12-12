@extends('layouts.master', ['categories' => $categories])
<?php

?>
@section('content')
<h1>Alle Articelen</h1>
<div class="row">
    @foreach($articles as $article)
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/storage/images/{{$article->image_ulr}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$article->name}}</h5>
                    <p class="card-text">&#8364; {{number_format($article->price)}}</p>
                    <a href="/articles/{{$article->id}}" class="btn-primary">Bekijk</a>
                    <a class="btn btn-success" href="/add-to-cart/{{$article->id}}" role="button"><i class="fas fa-cart-plus"></i></a>
                </div>
            </div>
            <br>
        </div>
    @endforeach
</div>

@endsection