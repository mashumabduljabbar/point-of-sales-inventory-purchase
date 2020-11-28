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
		<li class="">
          <a href="<?php echo base_url(); ?>login/logout">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>