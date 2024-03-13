<!-- header -->
<div class="agileits_header">
    <div class="container">
        <div class="w3l_offers">
            <p>DAPATKAN PENAWARAN MENARIK KHUSUS HARI INI, BELANJA SEKARANG!</p>
        </div>
        <div class="agile-login">
            <ul>
                @auth
                    <li style="color:white">Halo, {{ Auth::user()->name }}
                    @role('admin')
                        <li><a href="{{ route('admin.') }}">Admin Panel</a></li>
                    @endrole
                    <li><a href="/logout">Keluar?</a></li>
                @else
                    <li><a href="/register"> Daftar</a></li>
                    <li><a href="/login">Masuk</a></li>
                @endauth
            </ul>
        </div>
        <div class="product_list_header">
            <a href="cart.php"><button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
            </a>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>

<div class="logo_products">
    <div class="container">
        <div class="w3ls_logo_products_left1">
            <ul class="phone_email">
                <li><i class="fa fa-phone" aria-hidden="true"></i>Hubungi Kami : (+62) 8524 0982 023</li>
            </ul>
        </div>
        <div class="w3ls_logo_products_left">
            <h1><a href="/">H & R</a></h1>
        </div>
        <div class="w3l_search">
            <form action="search.php" method="post">
                <input type="search" name="Search" placeholder="Cari produk...">
                <button type="submit" class="btn btn-default search" aria-label="Left Align">
                    <i class="fa fa-search" aria-hidden="true"> </i>
                </button>
                <div class="clearfix"></div>
            </form>
        </div>

        <div class="clearfix"> </div>
    </div>
</div>
<!-- //header -->