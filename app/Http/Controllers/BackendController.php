<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Schema;
use DB;
use DataTables;
use App\barang;
use Webpatser\Uuid\Uuid;

use Session;

class BackendController extends Controller
{
    public function index()
    {
        
        
    }

    public function yajra(Request $request){
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
        

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('id_brg', 'whereRaw', '@id_brg  + 1 like ?', ["%{$keyword}%"]);
        }

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
            'harga'=>$barang->harga
        ]);
    }
    public function submit(Request $request, $code){
        $id_brg = $request->id_brg;
    	$qty = $request->qty;

    	\DB::table('code')->where('code_id',1)->update([
    		'code'=>$code,
    	]);

    	$cek = count(\DB::table('temp_transaksi')->where('id_brg',$id_brg)->where('code',$code)->get());
    	if($cek > 0){
    		$qtyNow = \DB::table('temp_transaksi')->where('id_brg',$id_brg)->where('code',$code)->value('qty');
    		\DB::table('temp_transaksi')->where('id_brg',$id_brg)->where('code',$code)->update([
    			'qty'=>$qtyNow+$qty
    		]);
    	}else{
    		
            \DB::table('temp_transaksi')->insert([
	    		'temp_transaksi_id'=>Uuid::generate(4),
	    		'code'=>$code,
	    		'id_brg'=>$id_brg,
	    		'qty'=>$qty
	    	]);
    	}

    	return redirect('/');
    	
    }
}
