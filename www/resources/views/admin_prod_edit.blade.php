@extends('layouts.app')
@section('content')
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <div>
                    <div class = "card-header">
                        <h1>Edit product</h1>
                        <a class = "btn btn-primary" href = "/home" role = "button">cabinet</a>
                        <a class = "btn btn-info" href = "/home/products" role = "button">view</a>
                        <a class = "btn btn-success" href = "/home/products/create" role = "button">create</a>
                    </div>

                    @if (session('status'))
                        <div class = "alert alert-success" role = "alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    <form id = "form-ins" method = "post" action = "/home/products">
                        @csrf
                        <p><b>Category:</b></p>
                        <select id = "select-ins" required name="category_id" required>
		                    <?php foreach ($allCat as $cat): ?>
                            <option value="@php($cat['id'])"><?= $cat['title'] ?></option>
		                    <?php endforeach; ?>
                        </select>
                        <br>
                        <p><b>Price:</b></p>
                        <input id = "input-ins" type = "number" required name = "price" pattern = "^\d+$" value = "">
                        <br>
                        <p><b>Is active?</b></p>
                        <select id = "select-ins" required name="is_active" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <br>
                        <p><b>Full description:</b></p>
                        <textarea id = "textarea-ins" rows = "4" cols = "100" name = "description" class = "message" required></textarea>
                        <br>
                        <p><b>Short description:</b></p>
                        <textarea id = "textarea-ins" rows = "2" cols = "50" name = "short_disc" class = "message" required></textarea>
                        <br>
                        <input type = "submit" name = "submit" class = "btn btn-warning" value = "edit">
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection