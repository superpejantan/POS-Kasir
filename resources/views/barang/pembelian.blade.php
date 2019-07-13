@extends('layouts.app')
@section('content')
       
<div class="blog-atas">
<a href="{{url('/')}}" class="btn btn-danger" style="width: 100px; height: 50px;">Menu</a>
</div>
<div class="blog-atas-1">
    <?php
        $total = 0;
            ?>
         <center>
                <h1><b><i class="total"></i></b></h1>
        </center>
</div>
<div class="blog-atas-2">
    <h2>Pembelian</h2>
    </div>
<div class="blog-kanan">

    <div class="container">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                $data = \DB::table('transaksi_pembelian')->where('code',$code)->get();
                            ?>
                            @foreach($data as $index=>$dt)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ \DB::table('barangs')->where('id_brg',$dt->id_brg)->value('barang') }}</td>
                                <td>{{ $dt->qty }}</td>
                                <?php
                                    $hrg = \DB::table('barangs')->where('id_brg',$dt->id_brg)->value('harga');
                                    $qty = $dt->qty;
                                    $sub = $hrg * $qty;
                                    $total += $sub;  
                                ?>  
                                <td>Rp. {{ number_format($sub,0) }}</td>
                                <td><a href="{{url('hapus_temp/'.$dt->id_beli.'/'.$code)}}" class="btn btn-danger">Hapus <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                            </tr>
                           @endforeach
                            
                            <tr>
                                <td colspan="5"><a href="" class="btn btn-block btn-warning btn-hapus"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus Transaksi</a></td>
                            </tr>
                        </tbody>
                    </table>            
    </div>
</div>
<div class="blog-kanan-2">
    <div id="container">   
        <table class="table table-hover table-barang">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barang</th>
                                    
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="blog-kanan-3">
    <form action="{{ url('submit/'.$code) }}" method="POST">
            @csrf
        <div class="col-25">
            <label for="barang">Barang</label>
            </div>
            <div class="col-75">
            <input type="text" name="brag" placeholder="barang">
        </div>
        <div class="col-25">
            <label for="harga">Harga </label>
            </div>
            <div class="col-75">
            <input type="text" name="harga" placeholder="harga">
        </div>
        <div class="col-25">
            <label for="jumlah">Jumlah</label>
            </div>
            <div class="col-75">
            <input type="number" name="qty" placeholder="jumlah">
        </div>
        <input type="hidden" name="id_brg">
        <input type="hidden" name="stock">
        <div class="col-75">
        <button style="margin-left: 80px;" type="submit" class="btn btn-outline btn-danger btn-submitt">Submit</button>
        </div>
    </form>
    </div>
    <div class="blog-kanan-4">
                    <form method="POST" action="{{ url('bayar/'.$code.'/'.$total) }}">
                        {{ csrf_field() }}
        <div class="col-25">
            <label for="barang">Total</label>
            </div>
            <div class="col-75">
            <input type="text" name="total" value="Rp. {{ number_format($total,0) }}" placeholder="barang">
        </div>
        <div class="col-25">
            <label for="barang">Bayar </label>
            </div>
            <div class="col-75">
            <input type="text" name="bayar" placeholder="barang">
        </div>
                <div class="col-25">
                <button style="margin-left: 80px;" type="submit" class="btn btn-primary">Bayar</button>
                </div>
    </form>
                
    </div>
@endsection
@section('scripts')

 <script type="text/javascript">
           
           var total = "{{ 'Rp. '.number_format($total,0) }}";
                $('.total').text(total);

           $('div.dataTables_filter input').focus();
           $('.table-barang').DataTable({
               "pageLength": 5,
               processing: true,
               serverSide: true,
               ajax: "{{ url('yajra/stock') }}",
               columns: [
                   // or just disable search since it's not really searchable. just add searchable:false
                   {data: 'id_brg', name: 'id_brg'},
                   {data: 'barang', name: 'barang'},
                  
               ]
           });

           $('body').on('click','.btn-barang',function(e){
                    e.preventDefault();
                    $(this).closest('tr').find('.loading').show();
                    var id = $(this).attr('barang-id');
                    var url = "{{ url('get') }}"+'/'+id;
                    var _this = $(this);

                    $.ajax({
                        type:'get',
                        url:url,
                        success:function(data){
                            console.log(data);

                            $("input[name='brag']").val(data.barang);
                            $("input[name='netto']").val(data.netto);
                            $("input[name='harga']").val(data.harga);
                            $("input[name='id_brg']").val(data.id_brg);
                            $("input[name='stock']").val(data.stock);
                            

                            _this.closest('tr').find('.loading').hide();
                        }
                    })
                });

                // Ketika submit di klik
                $('.btn-submitt').click(function(e){
                    e.preventDefault();
                    var barang = $("input[name='barang']").val();
                    var stock = $("input[name='stock']").val();
                    if(barang == ''){
                        // swal('Warning','Barang wajib dipilih terlebih dahulu','warning');
                        alert('pilih barang dahulu');
                    } if(stock <= '2'){
                      alert ('barang Habis');
                    } 
                    else{
                        $(this).addClass('disabled');
                        $(this).closest('form').submit();
                    }
                })
           
           
       
   </script>
@endsection

