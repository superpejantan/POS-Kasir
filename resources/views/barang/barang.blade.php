@extends('admin.layouts.dashboard')
@section('content')

		<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</h3>
		
        <form action="/search" method="get">
			<div class="input-group col-md-5 col-md-offset-7">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
				<div class="input-group">
					<input type="search" name="search" class="form-control" placeholder="Cari Barang">
				
				</div>
				</div>
           		</form>
			<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">
			<span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
			<table class="table table-hover">
			
				
					<tr>
						<th class="col-md-1">Id</th>
						<th class="col-md-1">Barang</th>
						<th>Netto</th>
						<th>Jumlah Awal</th>
                        <th>Harga</th>
                        <th>Stock</th>
						<th class="col-md-3">Action</th>
						
				</thead>
				<tbody>
					
					@foreach($barang as $brg)
					
					
						<td>{{$brg->id_brg}}</td>
						<td>{{$brg->barang}}</td>
						<td>{{$brg->netto}}</td>
						<td>{{$brg->jumlah}}</td>
						<td>Rp.{{number_format($brg->harga)}}</td>
						<td>{{$brg->stock}}</td>
						<td>
					<form action="{{action('BarangController@destroy', $brg->id_brg)}}" method="post">
					<input name="_method" type="hidden" value="delete">
							<button class="b" type="submit">Hapus</button>
					<a href="{{action('BarangController@edit', $brg->id_brg)}}" class="btn btn-warning">Edit</a>
						<a href="{{action('BarangController@show', $brg->id_brg)}}" class="btn btn-warning">Show</a>
							
						</form>
</td>
						</td>
				</tr>
					@endforeach
					<tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
						<td>&nbsp;</td>
                    </tr>
					
				

				</tbody>
				
			
			</table>
			{{$barang->links()}}
			
			<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				
			</div>
			<div class="modal-body">
			<form method="post" action="{{url('pembelian')}}">
			{{csrf_field()}}
            <h2>Tambah Barang</h2>
			
				
			<div class="form-group">
				<label for="id_brg"> ID Barang :</label>
				<input type="text" class="form-control" name="id_brg">
					</div>
					
			<div class="form-group">
					<label for="barang"> Barang :</label>
					<input type="text" class="form-control" name="brg">
					</div>
			<div class="form-group">
				<label for="netto"> Netto :</label>
					<input type="text" class="form-control" name="netto">
					</div>
					<div class="form-group">
					<label for="jumlah"> Jumlah :</label>
					<input type="text" class="form-control" name="jumlah">
					</div>
			<div class="form-group">
					<label for="harga"> Harga :</label>
					<input type="text" class="form-control" name="harga">
					</div>
					<div class="form-group">
					<label for="jenis"> Stock :</label>
					<input type="text" class="form-control" name="stock">
					</div>
					</div>
					<button type="submit" class="btn btn-succes" style="margin-left:38px">Tambah Produk</button>
					</br>
					</br>

			
</div>
</div>
</div>
</div>
			
			
@endsection
