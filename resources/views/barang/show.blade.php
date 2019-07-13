@extends('admin.layouts.dashboard')
@section('content')
<h2>show data produk</h2>

    @foreach ($barang as $file)
    <div class="row">
    
    <div class="col-md-4">
    <div class="card">
        <img class="card-img-top" >
        <div class="card-body">
            <strong class="card-title">{{$file->barang}}</strong>
            <p class="card-text">{{$file->harga}}</p>
            </div>
        </div>
    </div>
@endforeach
@endsection