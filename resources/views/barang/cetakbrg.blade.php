<!DOCTYPE html>
<html>
 <head>
  <title>Anikmart</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Laravel - How to Generate Dynamic PDF from HTML using DomPDF</h3><br />
   
   <div class="row">
    <div class="col-md-7" align="right">
     <h4>Laporan Penjualan</h4>
    </div>
    <form action="/search" method="get">
			<div class="input-group col-md-5 col-md-offset-7">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
				<div class="input-group">
					<input type="search" name="search" class="form-control" placeholder="Cari Barang">
					<div class="input-group">
</div>
				</div>
			</div>
			</form>
    <div class="col-md-5" align="right">
     <a href="{{ url('tampil_pdf') }}" class="btn btn-danger">Convert into PDF</a>
    </div>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <thead>
      <tr>
       <th>id_brg</th>
       <th>jumlah</th>
       <th>harga</th>
       <th>Barang</th>
       <th>tanggal</th>
       
      </tr>
     </thead>
     <tbody>
     @foreach($cetak as $brg)
      <tr>
       <td>{{ $brg->id_brg }}</td>
       <td>{{ $brg->jumlah }}</td>
       <td>{{ $brg->harga }}</td>
       <td>{{ $brg->barang }}</td>
       <td>{{$brg->created_at}}</td>
       
      </tr>
     @endforeach
     </tbody>
    </table>
   </div>
  </div>
 </body>
</html>