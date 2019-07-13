<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;
use App\pembelian;
use App\penjualan;

class CetakPembelianController extends Controller
{
   public function index()
   {
      $pembelian = DB::table('pembelian')->paginate(10);

      return view('all_pembelian',['pembelian'=>$pembelian]);
   }

   public function cetak()
   {
      
      $pembelian = pembelian::all();

      $pdf = PDF::loadview('laporan.all_pembelian', ['pembelian'=>$pembelian]);
      return $pdf->stream('cetak-pembelian-pdf');
   }

   public function cetak_bulan()
   {
      $month = Carbon::today()->format('F Y');
      $bulan = Carbon::today();
      $mont = $bulan->month;
      //dd($month);

      $pembelian = DB::table('pembelian')->whereMonth('tanggal',$mont)->get();

      $pdf = PDF::loadview('laporan.bulan_pembelian', ['pembelian'=>$pembelian, 'month'=>$month]);
      return $pdf->stream('cetak-pembelian-pdf');
   }

   public function cetak_harian()
   {
      $bulan = Carbon::today();
      $now  = Carbon::Now('Asia/jakarta')->format(' d F Y H:i');

      $pembelian = DB::table('pembelian')->where('tanggal',$bulan)->get();

      $pdf = PDF::loadview('laporan.harian_pembelian', ['pembelian'=>$pembelian, 'now'=>$now]);
      return $pdf->stream('cetak-pembelian-pdf');
   }






   
   public function cetak_mingguan()
   {
      $bulan = Carbon::now();
      $minggu = Carbon::today();
      $week = $minggu->subDay(7);
      //dd($week);
      $mingguan = DB::table('pembelian')->whereBetWeen('tanggal',[ $week,$bulan])->get();

      $pdf = PDF::loadview('laporan.mingguan_pembelian',['mingguan'=>$mingguan, 'week'=>$week, 'bulan'=>$bulan]);
      return $pdf->stream('laporan_pembelianmingguan_pdf');
   }

   public function cetak_acak(Request $request)
   {
      $bulan1 = $request->bulan1;
      $bulan2 = $request->bulan2;

      $acak = DB::table('pembelian')->whereBetWeen('tanggal',[$bulan1,$bulan2])->get();
      

      $pdf = PDF::loadview('laporan.acak_pembelian', ['acak'=>$acak, 'bulan1'=>$bulan1, 'bulan2'=>$bulan2]);
      return $pdf->stream('laporan_acak_bulan_pdf');
      //return view('laporan.acak_pembelian');
   }

   public function cetak_haraian(Request $request)
   {
   $hari = $request->hari;

   $harian = DB::table('pembelian')->where('tanggal', $hari);

   $pdf= PDF::loadview('laporan.pembelian_harian',['harian'=>$harian]);
   return $pdf->stream('laporan_pembelianharian_pdf');
   }
}
