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
<form action="{{url('/cari')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
          <input type="text" name="tanggal" class="form-control" placeholder="Cari Barang">
          <div class="input-group">
           <button type="submit" class="btn btn-succes" style="margin-left:38px">Cetak Produk</button>
</div>
        </div>
      </div>
      </form>
       <div class="col-md-5" align="right">
     <a href="{{ url('tampil_pdf') }}" class="btn btn-danger">Convert into PDF</a>
    </div>
</div>
</div>
</div>
</body>
</html>