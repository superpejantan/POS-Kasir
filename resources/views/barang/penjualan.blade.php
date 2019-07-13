@extends('admin.layouts.dashboard')
@section('content')
<form action="/search" method="get">
			<div class="input-group col-md-5 col-md-offset-7">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
				<div class="input-group">
					<input type="search" name="search" class="form-control" placeholder="Cari Barang">
					<div class="input-group">
			</div>
				</div>
			</div>
           <h1>Total Penjualan = {{$total}}</h1>
			</form>


			<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">
			<span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
			<table class="table table-hover" id="table">
			
				
					<tr>
					
						<th class="col-md-1">Barang</th>
						<th>Jumlah</th>
                        <th>Total</th>
						<th>Action</th>
						
				</thead>
				<tbody>
					
					@foreach($penjualan as $brg)
					
					
						
						<td>{{$brg->barang}}</td>
						<td>{{$brg->qty}}</td>
						<td>Rp.{{number_format($brg->total)}}</td>
						<td>
					<a href="{{action('PenjualanController@edit',$brg->id_jual)}}" class="btn btn-warning">Edit</a>
					<a href="{{action('PenjualanController@show',$brg->id_jual)}}" class="btn btn-warning">detail</a>
						</td>
							
						

						
						
						
</td>
						</td>
				</tr>
					@endforeach
					<tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
						<td>&nbsp;</td>
                        <td></td>
                        
                        
                     </tr>
                    </tr>
					
				

				</tbody>
				
				
			</table>
		{{$penjualan->links()}}
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

		
@endsection