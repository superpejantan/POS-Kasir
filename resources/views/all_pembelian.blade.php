@extends('admin.layouts.dashboard')
@section('content')
<form action="{{url('cetak/antara_bulan')}}" method="POST" class="form-inline">
	{{csrf_field()}}
  <div class="form-group">
    <label for="tanggal1">tanggal </label>
    <input type="text"  class="form-control" name="bulan1" placeholder="yyyy-mm-dd">
  </div>
  <div class="form-group">
    <label for="tanggal2"> Sampai Tanggal</label>
    <input type="text" class="form-control" name="bulan2" placeholder="yyyy-mm-dd">
  </div>

  <button type="submit" class="btn btn-primary">Cetak</button>
</form>
</br>
</br>
			
			<table class="table table-hover">
			
				
					<tr>
						<th class="col-md-1">ID Barang</th>
						<th class="col-md-1">Barang</th>
						<th class="col-md-1">Jumlah</th>
                        <th class="col-md-1">Total</th>
                        <th class="col-md-1">Tanggal</th>
						<th class="col-md-3">Action</th>
						
				</thead>
				<tbody>
					
					@foreach($pembelian as $brg)
					
					
						<td>{{$brg->id_brg}}</td>
						<td>{{$brg->barang}}</td>
						<td>{{$brg->qty}}</td>
						<td>Rp.{{number_format($brg->total)}}</td>
						<td>{{$brg->tanggal}}</td>
						<td>
					<a href="{{action('PenjualanController@edit',$brg->id_pmbelian)}}" class="btn btn-warning">Edit</a>
					<a href="{{action('PenjualanController@show',$brg->id_pmbelian)}}" class="btn btn-warning">detail</a>
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
			{{$pembelian->links()}}
		
@endsection