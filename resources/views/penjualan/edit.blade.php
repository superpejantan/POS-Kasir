@extends('admin.layouts.dashboard')
@section('content')
<h2>edit data produk</h2>
		
				
				<!-- form untuk mengedit action di arahkan ke function update pada productcontroller -->
				<form method="post" action="#">
				{{csrf_field()}}
				<input name="_method" type="hidden" value="PATCH">
				<div class="row">
							<div class="col-md-4"></div>
							<div class="form-group col-md-4">
									<label for="price">Harga</label>
									<input type="text class="form-controller" name="price" value="{{$penjualan->id_brg}}">
									</div>
									</div>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="form-group col-md-4">
									<label for="price">Harga</label>
									<input type="text class="form-controller" name="price" value="{{$penjualan->qty}}">
									</div>
									</div>
                                    <div class="row">
							<div class="col-md-4"></div>
							<div class="form-group col-md-4">
									<label for="price">Harga</label>
									<input type="text class="form-controller" name="price" value="{{$penjualan->total}}">
									</div>
									</div>
								
							<div class="row">
								<div class="col-md-4"></div>
								<div class="form-group col-md-4">
										<button type="submit" class="btn btn-succes" style="margin-left:38px">Update</button>
															</div>
														</div>
													</form>
											
@endsection