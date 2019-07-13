@extends('admin.layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-3 col-lg-offset-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{count(DB::table('barangs')->get())}}</h3>

          <p>Total Barang</p>
        </div>
        <div class="icon">
          <i class="ion ion-document"></i>
        </div>
        <a href="{{ url('data/barang') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
  </div>

       
        <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
         <h3>{{$jual}}</h3>

          <p>Total penjualan = {{$t_jual}}</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{ url('data/penjualan') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
  </div>
   <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$sum}}</h3>

          <p>Pembelian Barang = {{$transaksi}}</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{ url('data/barang') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
  </div>
    </div>
@endsection
