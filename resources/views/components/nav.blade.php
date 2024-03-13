<!-- navigation -->
<div class="navigation-agileits">
    <div class="container">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/" class="act">Home</a></li>
                    <!-- Mega Menu -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kategori Produk<b class="caret"></b></a>
                        <ul class="dropdown-menu multi-column columns-3">
                            <div class="row">
                                <div class="multi-gd-img">
                                    <ul class="multi-column-dropdown">
                                        <h6>Kategori</h6>
                                        @foreach ($data as $item)
                                            <li><a href="{{ route('category', $item->id) }}">{{ $item->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </ul>
                    </li>
                    @auth
                        <li><a href="cart.php">Keranjang Saya</a></li>
                        <li><a href="konfirmasi.php">Daftar Order</a></li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</div>