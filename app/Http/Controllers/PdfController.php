<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
class PdfController extends Controller
{
    public function index()
    {
     $customer_data = $this->get_customer_data();
     return view('cetaklap')->with('customer_data', $customer_data);
    }

    public function get_customer_data()
    {
      
     $customer_data = DB::table('barangs')->get();
     return $customer_data;
    }

    public function pdf()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_to_html());
     return $pdf->stream();
    }

    public function convert_to_html()
    {

     $customer_data =  DB::table('barangs')->get();
     $output = '
     <h3 align="center">Laporan Data Barang</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">ID</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Barang</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Jumlah</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Stock</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Tanggal</th>
    
   </tr>
     ';  
     foreach($customer_data as $customer)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$customer->id_brg.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->barang.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->jumlah.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->stock.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->created_at.'</td>
       
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;

      $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_to_html());
     return $pdf->stream();
    }
}
