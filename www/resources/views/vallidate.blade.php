@extends('layout')

@section('content')
<ul>
<?php foreach($validatedData as $v): ?>
    <li><?php echo $v ?></li>

<?php endforeach ?>
</ul>
@endsection