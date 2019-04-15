@extends('layouts.app')

@section('content')
    <div class="shopping-cart">
        <h1>Shopping cart</h1>
        @if(Session::has('cart'))
            <div class="row">
                <div class="col-12">
                    <ul class="list-group">
                        @foreach($products as $product)
                            <li class="list-group-item">
                                <div class="col-7 float-left">
                                    <strong>{{$product['item']['product_name']}}</strong>
                                    &euro;{{number_format($product['price'], 2)}}
                                    @if($product['item']['product_discount_percentage'] !== null)
                                        <strong class="discount">{{$product['item']['product_discount_percentage']}}&#37;</strong>
                                    @endif
                                </div>
                                <div class="col-5 float-right">
                                    <div class="row">
                                        <div class="input-group col-10">
                                            <div class="input-group-prepend">
                                                <a href="{{route('product.removeOneCartItem', ['id' => $product['item']['product_id']])}}" class="btn btn-outline-primary" title="Subtract" role="button">-</a>
                                            </div>
                                            <input type="text" class="form-control text-center border-color-primary" aria-label="Quantity" value="{{$product['qty']}}" disabled>
                                            <div class="input-group-append">
                                                <a href="{{route('product.addToCart', ['id' => $product['item']['product_id']])}}" class="btn btn-outline-primary col" title="Add" role="button">+</a>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="row">
                                                <a href="{{route('product.removeCartItems', ['id' => $product['item']['product_id']])}}" title="Remove" role="button" class="btn btn-outline-danger cart-delete-items">X</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-2">
                    <strong>Total: &euro;{{number_format($totalPrice, 2)}}</strong>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <a role="button" href="/orders/create" class="btn btn-primary">Checkout</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <p>This shits empty</p>
                    <h2>YEEEEEEEEEEEEEET!</h2>
                </div>
            </div>
        @endif
    </div>
@endsection