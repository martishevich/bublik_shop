@extends('layouts.adminka')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Products list</h1></div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        Вы удачно зашли!<?= Auth::user(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection