@extends('layouts.master', ['categories' => $categories])

@section('content')
@if(Session::has('cart'))
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <ul class="list-group">
                @foreach($articles as $key => $article)
                    <li class="list-group-item">

                        <strong>{{$article['item']['name']}}</strong>
                        <span class="badge badge-success">&#8364; {{$article['price']}}</span>
                        <div class="float-right">
                            <a class="btn btn-danger btn-sm" href="/shopping-cart/delete/{{$key}}">Delete item</a>
                            <a class="btn btn-warning btn-sm" href="/shopping-cart/remove-one/{{$key}}"><i class="fas fa-minus"></i></a>
                            <p style="displau:inline;">{{$article['qty']}}</p>
                            <a class="btn btn-success btn-sm" href="/shopping-cart/add-one/{{$key}}"><i class="fas fa=plus"></i></a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <p>Total price: {{$totalprice}}</p>
            {{Form::open(['action' => 'OrderController@store', 'method' => 'POST'])}}
                {{Form::submit('Place Order', ['class' => 'btn btn-secondary'])}}
            </form>
        </div>
    </div>

@else
    <h3>No items in your cart</h3>

@endif
    <br><a href="/articles" class="btn btn-primary">Continue shopping</a>
@endsection