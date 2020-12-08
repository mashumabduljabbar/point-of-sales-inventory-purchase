  <header class="main-header">
    <a href="" class="logo">
      <span class="logo-mini"><b>M</b></span>
      <span class="logo-lg"><b>MENU</b></span>
    </a>
    <nav class="navbar navbar-static-top" >
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		
		<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		  <!-- User Account: style can be found in dropdown.less -->
			  <li class="dropdown user user-menu">
				<ul class="dropdown-menu">
				  <!-- User image -->
				  <!-- Menu Footer-->
				  <li class="user-footer">
					<div class="pull-right">
					  <a href="<?php echo base_url(); ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
					</div>
				  </li>
				</ul>
			  </li>
			</ul>
      </div>
    </nav>
  </header>
  <?php
  $geturl = $this->uri->segment(1);
  $geturl2 = $this->uri->segment(2);
  $beranda = "";
  $kategori = "";
  $brand = "";
  $unit = "";
  $produk = "";
  $perusahaan = "";
  $supplier = "";
  $customer = "";
  $user = "";
  $master = "";
  
  if($geturl=="" or strpos($geturl, "index")!== FALSE){
	  $beranda = "active";
  }
  
  if(strpos($geturl, "kategori")!== FALSE){
	  $kategori = "active";
	  $master = "active";
  }
  if(strpos($geturl, "brand")!== FALSE){
	  $brand = "active";
	  $master = "active";
  }
  if(strpos($geturl, "unit")!== FALSE){
	  $unit = "active";
	  $master = "active";
  }
  if(strpos($geturl, "produk")!== FALSE){
	  $produk = "active";
  }
  if(strpos($geturl, "perusahaan")!== FALSE){
	  $perusahaan = "active";
	  $master = "active";
  }
  if(strpos($geturl, "supplier")!== FALSE){
	  $supplier = "active";
	  $master = "active";
  }
  if(strpos($geturl, "customer")!== FALSE){
	  $customer = "active";
	  $master = "active";
  }
  if(strpos($geturl, "user")!== FALSE){
	  $user = "active";
	  $master = "active";
  }
  
  $rfqsales = "";
  $so = "";
  $sales = "";
  
  if(strpos($geturl, "rfqsales")!== FALSE){
	  $rfqsales = "active";
	  $sales = "active";
  }
  if(strpos($geturl, "so")!== FALSE){
	  $so = "active";
	  $sales = "active";
  }  
  
  $rfqpurchase = "";
  $po = "";
  $purchase = "";
  
  if(strpos($geturl, "rfqpurchase")!== FALSE){
	  $rfqpurchase = "active";
	  $purchase = "active";
  }
  if(strpos($geturl, "po")!== FALSE){
	  $po = "active";
	  $purchase = "active";
  }
  
  $warehouse_masuk = "";
  $warehouse_keluar = "";
  $suratjalan = "";
  $stockopname = "";
  $warehouse = "";
  
  if(strpos($geturl2, "barang_masuk")!== FALSE){
	  $warehouse_masuk = "active";
	  $warehouse = "active";
  }
  if(strpos($geturl2, "barang_keluar")!== FALSE){
	  $warehouse_keluar = "active";
	  $warehouse = "active";
  }
  if(strpos($geturl, "suratjalan")!== FALSE){
	  $suratjalan = "active";
	  $warehouse = "active";
  }
  if(strpos($geturl, "stockopname")!== FALSE){
	  $stockopname = "active";
	  $warehouse = "active";
  }
  
  $stockcard = "";
  $report = "";
  $laporanpembelian = "";
  $laporanpenjualan = "";
  $laporanbarangmasuk = "";
  $laporanbarangkeluar = "";
  
  if(strpos($geturl, "stockcard")!== FALSE){
	  $stockcard = "active";
	  $report = "active";
  }
  if(strpos($geturl2, "laporanpembelian")!== FALSE){
	  $report = "active";
	  $purchase = "";
	  $laporanpembelian = "active";
  }
  if(strpos($geturl2, "laporanpenjualan")!== FALSE){
	  $report = "active";
	  $purchase = "";
	  $laporanpenjualan = "active";
  }
  if(strpos($geturl2, "laporanbarangmasuk")!== FALSE){
	  $report = "active";
	  $purchase = "";
	  $laporanbarangmasuk = "active";
  }
  if(strpos($geturl2, "laporanbarangkeluar")!== FALSE){
	  $report = "active";
	  $purchase = "";
	  $laporanbarangkeluar = "active";
  }
  
  
  //laporan penjualan (ada pilihan periode)
  //laporan pembelian (ada pilihan periode)
  // laporan barang_masuk
  // laporan barang_keluar
  // stockopname
  
  ?>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="<?php echo $beranda;?>">
          <a href="<?php echo base_url(); ?>admin">
            <span>Home</span>
          </a>
        </li>
		<li class="<?php echo $master;?> treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i> <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $kategori;?>">
				<a href="<?php echo base_url(); ?>kategori">
					<i class="fa fa-circle-o"></i> Kategori
				</a>
			</li>
            <li class="<?php echo $brand;?>">
				<a href="<?php echo base_url(); ?>brand">
					<i class="fa fa-circle-o"></i> Brand
				</a>
			</li>
            <li class="<?php echo $unit;?>">
				<a href="<?php echo base_url(); ?>unit">
					<i class="fa fa-circle-o"></i> Unit
				</a>
			</li>
            <li class="<?php echo $perusahaan;?>">
				<a href="<?php echo base_url(); ?>perusahaan">
					<i class="fa fa-circle-o"></i> Perusahaan
				</a>
			</li>
            <li class="<?php echo $supplier;?>">
				<a href="<?php echo base_url(); ?>supplier">
					<i class="fa fa-circle-o"></i> Supplier
				</a>
			</li>
            <li class="<?php echo $customer;?>">
				<a href="<?php echo base_url(); ?>customer">
					<i class="fa fa-circle-o"></i> Customer
				</a>
			</li>
            <li class="<?php echo $user;?>">
				<a href="<?php echo base_url(); ?>user">
					<i class="fa fa-circle-o"></i> User
				</a>
			</li>
          </ul>
        </li>
		<li class="<?php echo $produk;?>">
          <a href="<?php echo base_url(); ?>produk">
            <i class="fa fa-tv"></i> <span>Product</span>
          </a>
        </li>
		<li class="<?php echo $sales;?> treeview">
          <a href="#">
            <i class="fa  fa-line-chart"></i> <span>Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $rfqsales;?>">
				<a href="<?php echo base_url(); ?>rfqsales">
					<i class="fa fa-circle-o"></i> RFQ
				</a>
			</li>
            <li class="<?php echo $so;?>">
				<a href="<?php echo base_url(); ?>so">
					<i class="fa fa-circle-o"></i> SO
				</a>
			</li>
          </ul>
		</li>
		<li class="<?php echo $purchase;?> treeview">
          <a href="#">
            <i class="fa  fa-shopping-cart"></i> <span>Purchase</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $rfqpurchase;?>">
				<a href="<?php echo base_url(); ?>rfqpurchase">
					<i class="fa fa-circle-o"></i> RFQ
				</a>
			</li>
            <li class="<?php echo $po;?>">
				<a href="<?php echo base_url(); ?>po">
					<i class="fa fa-circle-o"></i> PO
				</a>
			</li>
          </ul>
		</li>
		<li class="<?php echo $warehouse;?> treeview">
          <a href="#">
            <i class="fa fa-bank"></i> <span>Warehouse</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $warehouse_masuk;?>">
				<a href="<?php echo base_url(); ?>warehouse/barang_masuk">
					<i class="fa fa-circle-o"></i> Barang Masuk
				</a>
			</li>
            <li class="<?php echo $warehouse_keluar;?>">
				<a href="<?php echo base_url(); ?>warehouse/barang_keluar">
					<i class="fa fa-circle-o"></i> Barang Keluar
				</a>
			</li>
            <li class="<?php echo $suratjalan;?>">
				<a href="<?php echo base_url(); ?>suratjalan">
					<i class="fa fa-circle-o"></i> Surat Jalan
				</a>
			</li>
            <li class="<?php echo $stockopname;?>">
				<a href="<?php echo base_url(); ?>stockopname">
					<i class="fa fa-circle-o"></i> Stock Opname
				</a>
			</li>
          </ul>
		</li>
		
		<li class="<?php echo $report;?> treeview">
          <a href="#">
            <i class="fa fa-file-o"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $laporanpembelian;?>">
				<a href="<?php echo base_url(); ?>report/laporanpembelian">
					<i class="fa fa-circle-o"></i> Laporan Pembelian
				</a>
			</li>
            <li class="<?php echo $laporanpenjualan;?>">
				<a href="<?php echo base_url(); ?>report/laporanpenjualan">
					<i class="fa fa-circle-o"></i> Laporan Penjualan
				</a>
			</li>
            <li class="<?php echo $laporanbarangmasuk;?>">
				<a href="<?php echo base_url(); ?>report/laporanbarangmasuk">
					<i class="fa fa-circle-o"></i> Laporan Barang Masuk
				</a>
			</li>
            <li class="<?php echo $laporanbarangkeluar;?>">
				<a href="<?php echo base_url(); ?>report/laporanbarangkeluar">
					<i class="fa fa-circle-o"></i> Laporan Barang Keluar
				</a>
			</li>
            <li class="<?php echo $stockcard;?>">
				<a href="<?php echo base_url(); ?>stockcard">
					<i class="fa fa-circle-o"></i> Stock Card
				</a>
			</li>
          </ul>
		</li>
		<li class="">
          <a href="<?php echo base_url(); ?>login/logout">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>