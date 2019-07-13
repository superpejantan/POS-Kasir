
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ (Request::path() == '/') ? 'active' : '' }}">
          <a href="{{url('/login')}}">
            <i class="fa fa-th"></i> <span>Home</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-check"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url ('transaksi/penjualan') }}"><i class="fa fa-circle-o"></i> transaksi penjualan</a></li>
            <li><a href="{{url ('pembelian') }}"><i class="fa fa-circle-o"></i> transaksi pembelian</a></li>
          </ul>
          
        </li>
        <li class="#">
          <a href="{{url('dynamic_pdf/pdf')}}">
            <i class="fa fa-check"></i> <span>cetak Barang</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fire"></i> <span>Barang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url ('data/barang') }}"><i class="fa fa-circle-o"></i> List Barang</a></li>
            <li><a href="{{url ('data/penjualan') }}"><i class="fa fa-circle-o"></i> barang terjual</a></li>
            <li><a href="{{url ('barangbeli') }}"><i class="fa fa-circle-o"></i> Barang Terbeli</a></li>
          </ul>
          
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fire"></i> <span>Cetak Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li class="treeview"><a href="#">
            <i class="fa fa-fire"></i> <span>Cetak Barang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('#')}}"><i class="fa fa-circle-o"></i> Laporan Barang</a></li>
          </ul>

           
            <li class="treeview"><a href="">
            <i class="fa fa-fire"></i> <span>Cetak Penjualan Barang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('cetak/data/penjualan')}}"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>
            <li><a href="{{url('cetak/harian_penjualan/pdf')}}"><i class="fa fa-circle-o"></i> Laporan harian</a></li>
            <li><a href="{{url('cetak/mingguan_penjualan/pdf')}}"><i class="fa fa-circle-o"></i> Laporan mingguan</a></li>
            <li><a href="{{url('cetak/bulan_penjualan/pdf')}}"><i class="fa fa-circle-o"></i> Laporan bulan</a></li>
          </ul>
       

            <li class="treeview"><a href="">
            <i class="fa fa-fire"></i> <span>Cetak Pembelian Barang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
            <li><a href="{{url('data/pembelian')}}"><i class="fa fa-circle-o"></i> Laporan pembelian</a></li>
           <li><a href="{{url('cetak/harian_pembelian/pdf')}}"><i class="fa fa-circle-o"></i> Laporan harian</a></li>
            <li><a href="{{url('cetak/mingguan_pembelian/pdf')}}"><i class="fa fa-circle-o"></i> Laporan mingguan</a></li>
            <li><a href="{{url('cetak/bulan_pembelian/pdf')}}"><i class="fa fa-circle-o"></i> Laporan bulan</a></li>
          </ul>
          </ul>
        </li>
       <li class="#">
          <a href="{{url('keluar')}}">
            <i class="fa fa-check"></i> <span>Log Out</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>