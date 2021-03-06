<?php if($this->getLoginStatus()): ?>

    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="" class="brand-link">
      <img src="skin/admin/assets/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">ADMIN
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="skin/admin/assets/logo.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Priyanshi Lunawat</a>
        </div>
        </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','admin',[],true)?>" class="nav-link">
                    <i class="right fa-solid fa-user"></i>
                    <p>Admin</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','cart',[],true)?>" class="nav-link">
                    <i class="right fa-solid fa-cart-shopping"></i>
                    <p>Cart</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','category',[],true)?>" class="nav-link">
                    <i class="right fa-solid fa-boxes-packing"></i>
                    <p>Category</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','config',[],true)?>" class="nav-link">
                    <i class="right fa-solid fa-gears"></i>
                    <p>Config</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','customer',[],true)?>" class="nav-link">
                    <i class="right fa-solid fa-users"></i>
                    <p>Customer</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','page',[],true)?>" class="nav-link">
                    <i class="right fa-solid fa-file-lines"></i>
                    <p>Page</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','product',[],true)?>" class="nav-link">
                    <i class="right fa-solid fa-boxes-stacked"></i>
                    <p>Product</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','salesman',[],true)?>" class="nav-link">
                    <i class="right fa-solid fa-people-arrows-left-right"></i>
                    <p>Salesman</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $this->getUrl('index','vendor',[],true)?>" class="nav-link">
                    <i class="right fa-solid fa-people-carry-box"></i>
                    <p>Vendor</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $this->getUrl('logout','admin_login',[],true)?>" class="nav-link">
                    <i class="right fa-solid fa-right-from-bracket"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
</aside>
<?php endif; ?>