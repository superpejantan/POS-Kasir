<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Toko Anikmart</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

        <style>
            .bg {
                background-color: white;
                padding: 25px;
                border: 5px solid #337ab7;
                margin: 25px;
            }
        </style>

    </head>
    <body>
        
        <div class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-default">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="{{ url('admin') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Admin</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    
                  </div><!-- /.container-fluid -->
                </nav>
            </div>
            <?php
                $total = 0;
            ?>
            <div class="row">
                <div class="col-md-12">
                    <center>
                        <h1><b><i class="total"></i></b></h1>
                    </center>
                </div>
            </div>
            <div id="container">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="panel panel-default bg">
                        <table class="table table-bordered table-barang">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
                <div class="col-md-6">
                    
                    <div class="panel panel-default bg">
                    <form action="{{ url('submit/'.$code) }}" method="POST">
                            {{ csrf_field() }}
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">netto</label>
                                    <input type="text" name="netto" class="form-control" id="exampleInputPassword1" placeholder="netto" disabled="">
                                  </div>
                              </div>
                          </div>

                          <div class="row">

                          <div class="col-md-6">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" name="harga" class="form-control" id="exampleInputEmail1" placeholder="harga" disabled="">
                          </div>
                          </div>

                          <div class="col-md-6">
                             <div class="form-group">
                            <label for="exampleInputPassword1">Barang</label>
                            <input type="text" name="brag" class="form-control"  placeholder="barang" >
                          </div>
                          </div>
                          </div>
                          <div class="row">

                              <div class="col-md-4 col-md-offset-4">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah</label>
                                    <input type="number" name="qty"  class="form-control" id="exampleInputEmail1" placeholder="jumlah" >
                                  </div>
                              </div>
                              <input type="hidden" name="id_brg" value="">
                              <input type="hidden" name="stock" value="">
                              
                          </div>

                          <button type="submit" class="btn btn-primary btn-block btn-success btn-submitt"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Submit</button>
                          <img src="{{ asset('loading.gif') }}" style="display: none;" class="loading">
                        </form>
                    </div>

                </div>
            </div>
            <!-- End Content -->
            <div class="container">
            <div class="row">
                <div class="col-md-8">
                <div style="overflow-x:auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                                <th>sisa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                $data = \DB::table('transaksi_penjualan')->where('code',$code)->get();
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
                                
                                <td>{{ \DB::table('barangs')->where('id_brg',$dt->id_brg)->value('stock') }}</td></td>
                                <td><a href="{{url('hapus_temp/'.$dt->temp_transaksi_id.'/'.$code)}}" class="btn btn-danger">Hapus <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                            </tr>
                           @endforeach
                            <tr>
                                
                               
                            </tr>
                            <tr>
                                <td colspan="5"><a href="" class="btn btn-block btn-warning btn-hapus"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus Transaksi</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="col-md-4">
                    <form method="POST" action="{{ url('bayar/'.$code.'/'.$total) }}">
                        {{ csrf_field() }}
                      <div class="form-group">
                        <label for="exampleInputEmail1">Total Harga</label>
                        <input type="text" name="total" class="form-control" id="exampleInputEmail1" placeholder="Total Harga" value="Rp. {{ number_format($total,0) }}" disabled="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Bayar (Rp)</label>
                        <input type="number" name="bayar" class="form-control" id="exampleInputPassword1" placeholder="Bayar">
                      </div>
                      <button type="submit" class="btn btn-primary btn-block btn-selesai">Selesai <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                    </form>
                </div>
            </div>
</div>
        </div>

        <!-- Modal Kembalian -->
        <div class="modal modal-danger fade" id="modal-kembalian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                <h1><b><i class="kembalian"></i></b></h1>
              </div>
              <div class="modal-footer">
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <!-- Modal Hapus Transaksi -->
        <div class="modal modal-danger fade" id="modal-hapus-transaksi">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Hapus Transaksi</h4>
              </div>
              <div class="modal-body">
                <h3><b><i>Yakin Ingin Menghapus Transaksi?</i></b></h3>
              </div>
              <div class="modal-footer">
                <a href="{{ url('hapus-transaksi/') }}" class="btn btn-outline btn-danger">Yakin</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <!-- Modal Simpan Transaksi -->
        <div class="modal modal-danger fade" id="modal-simpan-transaksi">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Simpan Transaksi Dengan Nama</h4>
              </div>
              <div class="modal-body">
                
                <form role="form" action="{{ url('simpan-transaksi/') }}" method="POST">
                  {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" placeholder="Nama Transaksi">
                    </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline btn-danger">Yakin</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
                

        <script src="{{asset('js/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{asset('js/jquery-ui.min.js')}}"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


        <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                var flash = "{{ Session::has('pesan') }}";
                if(flash){
                    var pesan = "{{ Session::get('pesan') }}";
                    $('.kembalian').text(pesan);
                    $('#modal-kembalian').modal();
                }

                var total = "{{ 'Rp. '.number_format($total,0) }}";
                $('.total').text(total);

                $('div.dataTables_filter input').focus();
                $('.table-barang').DataTable({
                    "pageLength": 5,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('yajra') }}",
                    columns: [
                        // or just disable search since it's not really searchable. just add searchable:false
                        {data: 'id_brg', name: 'id_brg'},
                        {data: 'barang', name: 'barang'},
                       
                    ]
                });

                
                 // Ketika nama barang di klik
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
                    var harga = $("input[name='barang']").val();
                    var stock = $("input[name='stock']").val();
                    if(stock <= '0'){
                        // swal('Warning','Barang wajib dipilih terlebih dahulu','warning');
                        alert('Barang sudah habis');
                    } if(harga == ''){
                      alert ('pilih barang dahulu');
                    } 
                    else{
                        $(this).addClass('disabled');
                        $(this).closest('form').submit();
                    }
                })
               

                // Ketika btn selesai di klik
                $('.btn-selesai').click(function(e){
                    e.preventDefault();
                    var total = "{{ $total }}";
                    var bayar = $("input[name='bayar']").val();

                    if(bayar < total){
                        alert('Uang Kurang');
                    }else{
                        $(this).closest('form').submit();
                    }

                })

                $(document).keypress(function(e){
                    if(e.which == 13){
                        $('div.dataTables_filter input').focus();
                        // $("Input[name='bayar']").focus();
                    }
                })

                $(document).keypress(function(e){
                    if(e.which == 118){
                        // $('div.dataTables_filter input').focus();
                        $("Input[name='bayar']").focus();
                    }
                })

                // Ketika btn hapus transaksi di klik
                $('.btn-hapus').click(function(e){
                    e.preventDefault();
                    $('#modal-hapus-transaksi').modal();
                })

                // Ketika btn simpan transaksi disimpan
                $('.btn-simpan').click(function(e){
                    e.preventDefault();
                    $('#modal-simpan-transaksi').modal();
                })

            })
        </script>

    </body>
</html>
