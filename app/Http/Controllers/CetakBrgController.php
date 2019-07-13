<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use App\barangs;
class CetakBrgController extends Controller
{
    public function index(Request $request)
    {
        $cetak = $this->cetak_barang($request);
        return view('barang.cetakbrg',['cetak'=>$cetak]);

    }

    public function cetak_barang()
    {
       $barang = barangs::all();

       $pdf = PDF::loadview('laporan.all_barang',['barang'=>$barang]);
        return $pdf->stream('cetak-barang-pdf');
    }
}
