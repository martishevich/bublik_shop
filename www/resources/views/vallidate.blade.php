@extends('layout')

@section('content')

<ul>
<?php foreach($post as $v): ?>
    <li><?php echo $v ?></li>

<?php endforeach ?>
</ul>

@endsection