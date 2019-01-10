@extends('layouts.app')
@section('content')
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <div>
                    <div class = "card-header">
                        <h1>Create new product</h1>
                        @if (isset($is_add) && $is_add == true)
                            <p class = "text-success">Данные удачно добавлены</p>
                        @endif
                        <a class = "btn btn-primary"
                           href = "/home"
                           role = "button">cabinet</a>
                        <a class = "btn btn-info"
                           href = "/home/products"
                           role = "button">view</a>
                    </div>
                    @if (session('status'))
                        <div class = "alert alert-success"
                             role = "alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    <form enctype = "multipart/form-data"
                          class = "form-ins"
                          method = "post"
                          action = "/home/products/create">
                        @csrf
                        <p><b>Category:</b></p>
                        <?php foreach ($errors->get('category_id') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <select class = "select-ins{{ $errors->has('category_id') ? '-is-invalid' : '' }}"
                                required
                                name = "category_id">
                            <?php foreach ($allCat as $cat): ?>
                            <option value = "<?= $cat['id'] ?>" <?= $cat['id'] == request()->old('category_id') ? 'selected' : '' ?>><?= $cat['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <p><b>Title:</b></p>
                        <?php foreach ($errors->get('name') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <input
                                class = "input-ins{{ $errors->has('name') ? '-is-invalid' : '' }}"
                                type = "text"
                                name = "name"
                                value = "{{ old('name') }}">
                        <p><b>Price:</b></p>
                        <?php foreach ($errors->get('price') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <input class = "input-ins{{ $errors->has('price') ? '-is-invalid' : '' }}"
                               name = "price"
                               pattern = "^[1-9]{1}\d{,15}(\.\d{1,2})?$"
                               value = "{{ old('price') }}">
                        <br>
                        <p><b>Is active?</b></p>
                        <?php foreach ($errors->get('is_active') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <input name = "is_active"
                               type = "radio"
                               value = "1"
                        <?= request()->old('is_active') == 1 ? 'checked' : '' ?>> Yes
                        <input name = "is_active"
                               type = "radio"
                               value = "0"
                        <?= request()->old('is_active') == 0 ? 'checked' : '' ?>> No<br>
                        </select>
                        <br>
                        <p><b>Full description:</b></p>
                        <?php foreach ($errors->get('description') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <textarea class = "textarea-ins{{ $errors->has('description') ? '-is-invalid' : '' }}"
                                  rows = "4"
                                  cols = "100"
                                  name = "description"
                                  class = "message">{{ old('description') }}</textarea>
                        <br>
                        <p><b>Short description:</b></p>
                        <?php foreach ($errors->get('short_disc') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <textarea class = "textarea-ins{{ $errors->has('short_disc') ? '-is-invalid' : '' }}"
                                  rows = "2"
                                  cols = "50"
                                  name = "short_disc"
                                  class = "message">{{ old('short_disc') }}</textarea>
                        <br>
                        <label class = "btn btn-default">
                            <i class = "fas fa-download"></i>
                            open image...<input type = "file"
                                                name = "image"
                                                hidden>
                        </label>
                        <input type = "submit"
                               name = "submit"
                               class = "btn btn-success"
                               value = "create">
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection