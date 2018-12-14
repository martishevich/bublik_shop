@extends('layouts.app')
@section('content')
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class = "card">
                    <div class = "card-header"><h1>Личный кабинет</h1></div>

                    <div class = "card-body">
                        @if (session('status'))
                            <div class = "alert alert-success" role = "alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        Вы удачно зашли!
                            <h2>Products</h2>
                            <div class="btn-toolbar">
                                <div class="btn-group">
                            <a class="btn btn-info" href="/home/products" role="button">view</a>
                            <a class="btn btn-success" href="/home/products/create" role="button">add new</a>
                                </div>
                            </div>
                            <h2>Orders</h2>
                            <a class="btn btn-info" href="/home/orders" role="button">view</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
