@extends('layouts.app')
@section('content')
    <div class = "container">
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <div>
                    <div class = "card-header">
                        <h1>Edit product</h1>
                        <a class = "btn btn-primary"
                           href = "/home"
                           role = "button">cabinet</a>
                        <a class = "btn btn-info"
                           href = "/home/products"
                           role = "button">view</a>
                        <a class = "btn btn-success"
                           href = "/home/products/create"
                           role = "button">create</a>
                    </div>
                    @if (session('status'))
                        <div class = "alert alert-success"
                             role = "alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    <form enctype = "multipart/form-data"
                          id = "form-ins"
                          method = "post"
                          action = "/home/products/edit/<?php echo $prod->id ?>">
                        @csrf
                        <p><b>Category:</b></p>
                        <?php foreach ($errors->get('category_id') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <select class = "select-ins"
                                required
                                name = "category_id"
                                required>
                            <?php foreach ($allCat as $cat): ?>
                            <option <?php echo $cat['id'] == $prod->category_id ? 'selected' : '' ?> value = "<?= $cat['id'] ?>"> <?php echo $cat['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <p><b>Title:</b></p>
                        <?php foreach ($errors->get('name') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <input class = "input-ins"
                               type = "text"
                               required
                               name = "name"
                               value = "<?= $prod->name ?>">
                        <p><b>Price:</b></p>
                        <?php foreach ($errors->get('price') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <input class = "input-ins"
                               required
                               name = "price"
                               value = "<?= $prod->price?>">
                        <br>
                        <p><b>Is active?</b></p>
                        <?php foreach ($errors->get('is_active') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <input name = "is_active"
                               type = "radio"
                               value = "1" <?php echo $prod->is_active == 1 ? 'checked' : '' ?>> Yes
                        <input name = "is_active"
                               type = "radio"
                               value = "0" <?php echo $prod->is_active == 0 ? 'checked' : '' ?>> No<br>
                        </select>
                        <br>
                        <p><b>Full description:</b></p>
                        <?php foreach ($errors->get('description') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <textarea class = "textarea-ins"
                                  rows = "4"
                                  cols = "100"
                                  name = "description"
                                  class = "message"
                                  required><?= $prod->description ?></textarea>
                        <br>
                        <p><b>Short description:</b></p>
                        <?php foreach ($errors->get('short_disc') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <textarea class = "textarea-ins"
                                  rows = "2"
                                  cols = "50"
                                  name = "short_disc"
                                  class = "message"
                                  required><?= $prod->short_disc ?></textarea>
                        <br>
                        <?php foreach ($errors->get('image') as $message):?>
                        <p class = "text-danger"><?= $message ?></p>
                        <?php endforeach; ?>
                        <label class = "btn btn-default">
                            <i class = "fas fa-download"></i>
                            open image...<input type = "file"
                                                name = "image"
                                                hidden>
                        </label>
                        <input type = "submit"
                               name = "submit"
                               class = "btn btn-warning"
                               value = "save">
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection