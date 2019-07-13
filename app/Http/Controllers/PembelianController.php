<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;
use App\Barang;
use DataTables;
use Webpatser\Uuid\Uuid;

class PembelianController extends Controller
{
    public function index()
    {
        $suplier = DB::table('suplier')->get();
        $code = \DB::table('code')->where('code_id',1)->value('code');
        if($code == '0'){
            $code = Uuid::generate(4);
        }
       
        return view('barang.pembelian', compact('code','suplier'));
    }

    public function get($id_brg){
        $barang = DB::table('barangs')->where('id_brg',$id_brg)->first();
        return response()->json([
            'id_brg'=>$barang->id_brg,
            'barang'=>$barang->barang,
            'netto'=>$barang->netto,
            'harga'=>$barang->harga,
            'stock'=>$barang->stock
        ]);
    }

    public function data()
    {
        $data = DB::table('pembelian')
        ->join('suplier','pembelian.id_suplier','suplier.id_suplier')
        ->paginate(10);
        $total = DB::table('pembelian')->sum('total');
        return view('barang.belibarang', ['data'=>$data, 'total'=>$total]);
    }

    public function masuk(Request $request, $code){
        $id_brg = $request->id_brg;
        $qty = $request->qty;
        $brg = $request->barang;
        $suplier = $request->suplier;
        $sisa = $request->stock;

        $stock = $sisa+$qty;
       // dd($suplier);

        \DB::table('code')->where('code_id',1)->update([
            'code'=>$code,
        ]);
      
       $barang = DB::update('update barangs set  stock=? where id_brg=?', 
            [$stock, $id_brg]);

        $cek = count(\DB::table('transaksi_pembelian')->where('id_brg',$id_brg)->where('code',$code)->get());
        if($cek > 0){
            $qtyNow = \DB::table('transaksi_pembelian')->where('id_brg',$id_brg)->where('code',$code)->value('qty');
            \DB::table('transaksi_pembelian')->where('id_brg',$id_brg)->where('code',$code)->update([
                'qty'=>$qtyNow+$qty
            ]);
        }else{
            \DB::table('transaksi_pembelian')->insert([
                'id_beli'=>Uuid::generate(4),
                'code'=>$code,
                'id_brg'=>$id_brg,
                'barang'=>$brg,
                'id_suplier'=>$suplier,
                'qty'=>$qty
                
            ]);
           
        }
        

        return redirect('/pembelian');
        
    }
    public function stock(Request $request){
        DB::statement(DB::raw('set @rownum=0'));
        $barang = DB::table('barangs')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'id_brg',
                'barang',
               
            ]);
        $datatables = Datatables::of($barang)->editColumn('barang',function($barang){
            $id = $barang->id_brg;
            $gambar = asset('loading.gif');
            return '<span barang-id="'.$id.'" style="cursor:pointer;" class="btn-barang">'.$barang->barang.'</span>'.'<img src="'.$gambar.'" style="display:none;" class="loading">';
        })->rawColumns(['barang']);

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('barang', 'whereRaw', '@barang  + 1 like ?', ["%{$keyword}%"]);
        }

        return $datatables->make(true);
    }

    public function bayar(Request $request, $code, $total){
        $bayar = $request->bayar;
        $barang = $request->barang;
        $data  = DB::table('transaksi_pembelian')->where('code',$code)->get();

        foreach ($data as $key=>$dt) {
            DB::table('pembelian')->insert([
                'id_pmbelian'=>Uuid::generate(4),
                'id_brg'=>$dt->id_brg,
                'qty'=>$dt->qty,
                'total'=>$total,
                'barang'=>$dt->barang,
                'tanggal' => date("Y-m-d H:i:s")

            ]);
        }
        DB::table('code')->where('code_id',1)->update([
            'code'=>0
            ]);    
        DB::table('transaksi_pembelian')->where('code',$code)->delete();
        DB::table('simpan_transaksi')->where('code', $code)->delete();
         $kembalian = $bayar - $total;
           
        
        return redirect('/pembelian');
    }
   
     public function delete()
    {
        DB::table('pembelian')->where('id_beli')->delete();
    }
    public function hapus($id,$code)
    {
        $data = DB::table('transaksi_pembelian')->where('id_beli')->select('qty');

        DB::table('transaksi_pembelian')->where('id_beli', $id)->where('code',$code)->delete();
        return redirect()->back();
    } 
    
}
