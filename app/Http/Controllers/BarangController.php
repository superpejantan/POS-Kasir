<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;
use App\barangs;
use App\pembelian;
use Session;
use DataTables;
use PDF;
use Webpatser\Uuid\Uuid;
use Carbon\Carbon;
use Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = carbon::today('Asia/jakarta','Y-m-d');
        $sum = DB::table('pembelian')->where('tanggal',$now)->sum('total');
        $transaksi = count(\DB::table('pembelian')->where('tanggal',$now)->get());
        $jual = DB::table('jual')->where('tanggal',$now)->sum('total');
        $t_jual = count(\DB::table('jual')->where('tanggal',$now)->get());

        return view('barang.beranda',['sum'=>$sum,'transaksi'=>$transaksi, 'jual'=>$jual, 't_jual'=>$t_jual]);
        //return view('barang.barang',['barang'=>$barang]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function barang()
    {
        $barang = DB::table('barangs')->paginate(8);
        return view('barang.barang',['barang'=>$barang]); 
    }
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = $this->validate(request(),[
            'id_brg' => 'required|numeric',
            'barang' => 'required',
            'harga'  => 'required|numeric',
            'netto'  => 'required',
            'jumlah' => 'required|numeric',
            'stock'  => 'required|numeric'
        ]);
        barangs::create($barang);


        return redirect('data/barang');


    }

    public function pembelian(Request $request)
    {
        $id = $request->id_brg;
        $id_pem = Uuid::generate(4);
        $barang = $request->brg;
        $harga = $request->harga;
        $netto = $request->netto;
        $jumlah = $request->jumlah;
        $total = $jumlah * $harga;
        $tanggal = date("d-m-y");

        $barangs = new barangs;
        $barangs->id_brg = $id;
        $barangs->barang = $barang;
        $barangs->harga  = $harga;
        $barangs->netto  = $netto;
        $barangs->jumlah = $jumlah;
        $barangs->save();

        $beli = new pembelian;
        $beli->id_pmbelian = $id_pem;
        $beli->barang = $barang;
        $beli->id_brg = $id;
        $beli->total = $total;
        $beli->tanggal = $tanggal;
        $beli->qty = $jumlah;
        $beli->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_brg)
    {
        $barang = DB::select('select *from barangs where id_brg=?', [$id_brg]);
        
        return view('barang.show',['barang'=>$barang]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(barangs $id_brg)
    {
        $penjualan = barangs::find($id_brg);
        
        return view('barang.update',compact('penjualan'));
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
    public function destroy($id_brg)
    {
        $barang = DB::delete('delete from barangs where id_brg=?',[$id_brg]);
        return redirect()->back();
    }
     public function cetaklapp(){
         $pdf = PDF::loadView('barang.barang');
         return $pdf->download('barang.pdf');
     }

     public function CetakBrg()
     {
     $pdf = PDF::loadView('barang.barang');
     return $pdf->download(barang.pdf);
     }

     public function keluar()
     {
        Auth::logout();
        return redirect('login');
     }

    
}
