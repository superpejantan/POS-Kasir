<html>
<head>
	<title>Laporan Pembelian Toko Anikmart</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>LAPORAN PEMBELIAN</h4>
		<h6>Toko Anikmart</h5>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
						<th>No</th>
						<th>Barang</th>
						<th>Jumlah</th>
                        <th>Total</th>
				
				
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($pembelian as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->barang}}</td>
				<td>{{$p->qty}}</td>
				<td>Rp.{{number_format($p->total)}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>