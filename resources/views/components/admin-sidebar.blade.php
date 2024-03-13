<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ (Request::is('admin') ? 'active' : '') }}"><a href="index.php"><span>Home</span></a></li>
                    <li><a href="../"><span>Kembali ke Toko</span></a></li>
                    <li>
                        <a href="manageorder.php"><i class="ti-dashboard"></i><span>Kelola Pesanan</span></a>
                    </li>
                    <li class="{{ (Request::is('admin/*') ? 'active' : '') }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Kelola Toko
                            </span></a>
                        <ul class="collapse">
                            <li class="{{ (Request::is('admin/category') ? 'active' : '') }}"><a href="{{ route('admin.category.index') }}">Kategori</a></li>
                            <li class="{{ (Request::is('admin/product') ? 'active' : '') }}"><a href="{{ route('admin.product.index') }}">Produk</a></li>
                            <li><a href="pembayaran.php">Metode Pembayaran</a></li>
                        </ul>
                    </li>
                    <li><a href="laporan.php"><span>Laporan</span></a></li>
                    <li><a href="customer.php"><span>Kelola Pelanggan</span></a></li>
                    <li><a href="user.php"><span>Kelola Staff</span></a></li>
                    <li>
                        <a href="{{ route('admin.logout') }}"><span>Logout</span></a>
                    </li>
                    
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->