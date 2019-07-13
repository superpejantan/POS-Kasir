@extends('admin.layouts.dashboard')
@section('content')
<form action="{{url('cetak/laporan/antara_bulan')}}" method="POST" class="form-inline">
	{{csrf_field()}}
  <div class="form-group">
    <label for="tanggal1">tanggal </label>
    <input type="text" class="form-control" name="bulan1" placeholder="yyyy-mm-dd">
  </div>
  <div class="form-group">
    <label for="tanggal2"> Sampai Tanggal</label>
    <input type="text" class="form-control" name="bulan2" placeholder="yyyy-mm-dd">
  </div>
  <button type="submit" class="btn btn-primary">Cetak</button>
</form>

				<table class="table table-hover" id="table">
					<tr>
					
						<th class="col-md-1">Barang</th>
						<th>Jumlah</th>
                        <th>Total</th>
                        <th>Tanggal</th>
						
						
				</thead>
				<tbody>
					
					@foreach($penjualan as $brg)
					
					
						
						<td>{{$brg->barang}}</td>
						<td>{{$brg->qty}}</td>
						<td>Rp.{{number_format($brg->total)}}</td>
						<td>{{$brg->tanggal}}</td>
						<!--<td>
					<a href="{{action('PenjualanController@edit',$brg->id_jual)}}" class="btn btn-warning">Edit</a>
					<a href="{{action('PenjualanController@show',$brg->id_jual)}}" class="btn btn-warning">detail</a>
						</td>-->							
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