<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\penjualan;
use DB;
use Carbon\Carbon;

class CetakPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = DB::table('jual')->paginate(10);
        return view('all_penjualan', ['penjualan'=>$penjualan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cetak()
    {
        $penjualan = penjualan::all();

        $pdf = PDF::loadview('laporan.all_penjualan', ['penjualan'=>$penjualan]);
        return $pdf->stream('cetak-pembelian-pdf'); 
    }

    public function cetak_harian()
    {
        
        $hari = Carbon::today();
        $now  = Carbon::Now('Asia/jakarta')->format(' d F Y H:i');
        //dd($hari);
        $penjualan = DB::table('jual')->where('tanggal',$hari)->get();

        $pdf = PDF::loadview('laporan.harian_penjualan', ['penjualan'=>$penjualan, 'now'=>$now]);
        return $pdf->stream('cetak-penjualanharian-pdf');
    }

    public function cetak_mingguan()
    {
        $tanggal1 = Carbon::today();
        $tanggal2 = $tanggal1->subDay(6)->format('d F Y');
        $bulan = Carbon::tomorrow();
        $minggu = Carbon::today();
        $week = $minggu->subDay(6);
        //$week1 = $minggu->subDay(6)->format(' d F Y');
        $week2 = Carbon::today()->format('d F Y');
        $mingguan = DB::table('jual')->whereBetWeen('tanggal',[ $week,$bulan])->get();
        //dd($week);
        $pdf = PDF::loadview('laporan.mingguan_penjualan',['mingguan'=>$mingguan, 'week'=>$week,'tanggal2'=>$tanggal2, 'week2'=>$week2,'bulan'=>$bulan]);
        return $pdf->stream('laporan_penjualanmingguan_pdf');
    }

    public function cetak_bulan()
    {
        $month = Carbon::today()->format('F Y');
        $bulan = Carbon::today();
      $mont = $bulan->month;
      //dd($mont);
      $penjualan = DB::table('jual')->whereMonth('tanggal',$mont)->get();

      $pdf = PDF::loadview('laporan.bulan_penjualan', ['penjualan'=>$penjualan, 'month'=>$month]);
      return $pdf->stream('cetak-penjualanbulan-pdf');
    }

    public function cetak_acak(Request $request)
   {
      $bulan1 = $request->bulan1;
      $bulan2 = $request->bulan2;

      $acak = DB::table('jual')->whereBetWeen('tanggal',[$bulan1,$bulan2])->get();
      

      $pdf = PDF::loadview('laporan.acak_penjualan', compact('bulan1','bulan2','acak'));
      return $pdf->stream('laporan_acak_bulan_pdf');
      //return view('laporan.acak_pembelian');
   }
}
