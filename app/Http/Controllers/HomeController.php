<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Schema;
use DB;
use DataTables;
use App\barang;
use allert;
use Webpatser\Uuid\Uuid;

use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $code = \DB::table('code')->where('code_id',1)->value('code');
    	if($code == '0'){
    		$code = Uuid::generate(4);
    	}
        return view('home',compact('code'));
    }

    public function tampil(Request $request){
    	DB::statement(DB::raw('set @rownum=0'));
        $barang = DB::table('barangs')->where('stock', '>',3)->select([
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
        

       

        return $datatables->make(true);
    }

    
    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                //echo "succes login";die;
               /* Session::put('adminSession',$data['email']);*/
                return redirect('admin.layouts.dashboard');
            }else{
                
                return redirect('/admin')->with('flash_message_error','invalid Username or Password');
            }
        }
        return view('auth.login');
    }
    public function get($id){
        $barang = DB::table('barangs')->where('id_brg',$id)->first();
        return response()->json([
            'barang'=>$barang->barang,
            'netto'=>$barang->netto,
            'harga'=>$barang->harga,
            'stock'=>$barang->stock,
            'id_brg'=>$barang->id_brg
        ]);
    }
    public function submit(Request $request, $code){
        $id_brg = $request->id_brg;
        $qty = $request->qty;
        $stock = $request->stock;
        $brg = $request->brag;
        
        $jumlah = $stock-$qty;
        if($stock < $qty){
            Session::flash('pesan','barang tidak cukup');
            return redirect()->back();
        }
        \DB::table('barangs')->where('id_brg',$id_brg)->update([
            'stock'=>$jumlah

        ]);
        //$penjualan = DB::update('update barangs set jumlah=?, ', [$jumlah]);
        
        

    	\DB::table('code')->where('code_id',1)->update([
    		'code'=>$code,
    	]);

    	$cek = count(\DB::table('transaksi_penjualan')->where('id_brg',$id_brg)->where('code',$code)->get());
    	if($cek > 0){
    		$qtyNow = \DB::table('transaksi_penjualan')->where('id_brg',$id_brg)->where('code',$code)->value('qty');
    		\DB::table('transaksi_penjualan')->where('id_brg',$id_brg)->where('code',$code)->update([
    			'qty'=>$qtyNow+$qty
    		]);
    	}else{
    		\DB::table('transaksi_penjualan')->insert([
	    		'temp_transaksi_id'=>Uuid::generate(4),
	    		'code'=>$code,
	    		'id_brg'=>$id_brg,
                'qty'=>$qty,
                'barang'=>$brg
               
	    	]);
    	}

    	return redirect()->back();
    	
    }
    public function bayar(Request $request, $code, $total)
    {
        $bayar =$request->bayar;

        $data =DB::table('transaksi_penjualan')->where('code',$code)->get();

        foreach($data as $dt){
            DB::table('jual')->insert([
                'id_jual'=>Uuid::generate(4),
                'id_brg'=>$dt->id_brg,
                'barang'=>$dt->barang,
                'qty'=>$dt->qty,
                'total'=>$total,
                'tanggal'=>date("Y-m-d")
            ]);
        }

        DB::table('transaksi_penjualan')->where('code',$code)->delete();
        return redirect('/home');
    }

    public function hapus($id,$code)
    {
        $data = DB::table('transaksi_penjualan')->where('temp_transaksi_id')->select('qty');
        

        

        DB::table('transaksi_penjualan')->where('temp_transaksi_id', $id)->where('code',$code)->delete();
        return redirect('/home');
    } 

}
