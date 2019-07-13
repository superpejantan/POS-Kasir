<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;
use DataTables;
class PenjualanController extends Controller
{
    public function index()
    {
       $code = \DB::table('code')->where('code_id',1)->value('code');
        if($code == '0'){
            $code = Uuid::generate(4);
        }
       
        return view('penjualan.penjualan', compact('code'));
    }

    public function penjualan()
    {
         $penjualan = DB::table('jual')->paginate(10);
        $total = DB::table('jual')->sum('total');
        return view('barang.penjualan', ['penjualan'=>$penjualan, 'total'=>$total]);
    }

    public function yajra_barang()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $barang = DB::table('barangs')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            	'id_brg',
            	'barang',
        	]);
        $datatables = Datatables::of($barang)->editColumn('barang',function($barang){
            $id = $barang->id_brg;
            $gambar = asset('');
            return '<span barang-id="'.$id.'" style="cursor:pointer;" class="btn-barang">'
            .$barang->barang.'</span>'.'<img src="'.$gambar.'" style="display:none;" class="loading">';
        	
        	return ''.$barang->barang.'';
        })->rawColumns(['barang']);
    }
 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_jual)
    {
        $penjualan = DB::select('select *from jual where id_jual=?',[$id_jual]);
        return view('penjualan.show',['penjualan'=>$penjualan]);
    }
    public function edit($id_jual)
    {
        $penjualan = DB::select('select *from jual where id_jual=?',[$id_jual]);
        return view('penjualan.update',compact('penjualan'));
    }

    public function update($id_jual)
    {
        $id_jual =$request->get('id_jual');
        $id_brg = $request->get('id_brg');
        $barang = $request->get('barang');
        $total = $request->get('total');
        $tanggal = date("d-m-y H:i:s");

        $penjualan = DB::update('update penjualan set id_jual=?, barang=?, total=?', [$id_jual, $barang, $barang, $total, $tanggal]);
        return redirect ('penjualan');

    }

    public function hapus ($id_jual)
    {
        $penjualan = DB::delete('select *from jual where id_jual',[$id_jual]);
        $red = redirect('penjualan');
        return $red;
    }
}
