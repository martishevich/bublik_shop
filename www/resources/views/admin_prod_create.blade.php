@extends('layouts.app')
@section('content')
    <?php var_dump($_POST) ?>
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <div class = "card">
                    <div class = "card-header">
                        <h1>Create new product</h1>
                        <a class="btn btn-primary" href="/home" role="button">cabinet</a>
                        <a class="btn btn-info" href="/home/products" role="button">view</a>
                    </div>

                    @if (session('status'))
                        <div class = "alert alert-success" role = "alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    <form id="form-ins" method="post" action="/home/products/create">
                        @csrf
                        <input id="input-ins" type="number" required name="category_id" pattern="^\d+$" placeholder="Category id" value="">
                        <br>
                        <input id="input-ins" type="text" required name="name" placeholder="Title product" value="">
                        <br>
                        <input id="input-ins" type="number" required name="price" pattern="^\d+$" placeholder="Price (integer)" value="">
                        <br>
                        <input id="input-ins" type="number" required name="is_active" pattern="^[01]$" placeholder="1 = on, 0 = off" value="">
                        <br>
                        <textarea id="textarea-ins" rows="4" cols="100" name="description" placeholder="Full description" class="message" required></textarea>
                        <br>
                        <textarea id="textarea-ins" rows="2" cols="50" name="short_disc" placeholder="Short description" class="message" required></textarea>
                        <br>
                        <input type="submit" name="submit" class="btn123" value="Save">
                    </form>
                    <br>
                    {{--<form method = "post">
                        <input name="name" placeholder="Укажите ваше имя!" class="name" required />
                        <input name="emailaddress" placeholder="Укажите ваш Email!" class="email" type="email" required />
                        <textarea rows="4" cols="50" name="subject" placeholder="Введите ваше сообщение:" class="message" required></textarea>
                        <input name="submit" class="btn123" type="submit" value="Отправить" />
                    </form>--}}
                </div>
            </div>
        </div>
    </div>
@endsection