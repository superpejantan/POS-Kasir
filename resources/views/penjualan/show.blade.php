@extends('admin.layouts.dashboard')
@section('content')
<h2>edit data produk</h2>

    
    <div class="row">
							<div class="col-md-4"></div>
							<div class="form-group col-md-4">
									<label for="price">Harga</label>
									<input type="text class="form-controller" name="price" value="{{$penjualan->barang}}">
									</div>
									</div>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="form-group col-md-4">
									<label for="price">Harga</label>
									<input type="text class="form-controller" name="price" value="{{$brg->total}}">
									</div>
									</div>
@endforeach
@endsection