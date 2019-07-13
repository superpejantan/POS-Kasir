@extends('admin.layouts.dashboard')
@section('content')
<h2>edit data produk</h2>
	
	@foreach($penjualan as $penjualan)			
				<!-- form untuk mengedit action di arahkan ke function update pada productcontroller -->
				<form method="post" action="{{action('updateController@update', $penjualan->id_jual)}}">
				{{csrf_field()}}
				
				<div class="row">
							<div class="col-md-4"></div>
							<div class="form-group col-md-4">
									<label for="price">Harga</label>
									<input type="text" class="form-control" name="qty" value="{{$penjualan->id_jual}}">
									</div>
									</div>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="form-group col-md-4">
									<label for="price">Harga</label>
									<input type="text" class="form-control" name="barang" value="{{$penjualan->barang}}">
									</div>
									</div>
                                    <div class="row">
							<div class="col-md-4"></div>
							<div class="form-group col-md-4">
									<label for="price">Harga</label>
									<input type="text" class="form-control" name="total" value="{{$penjualan->total}}">
									</div>
									</div>
							@endforeach		
							<div class="row">
								<div class="col-md-4"></div>
								<div class="form-group col-md-4">
										<button type="submit" class="btn btn-succes" style="margin-left:38px">Update</button>
															</div>
														</div>
													</form>
									
@endsection