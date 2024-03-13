@extends('layouts.login-layout')

@section('breadcrumb')
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
                <li class="active">Category</li>
                <li class="active">{{ $product->name }}</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
@endsection

@section('main')
    <!--- beverages --->
	<div class="products">
		<div class="container">
			<div class="col-md-4 products-left">
				<div class="categories">
					<h2>Categories</h2>
					<ul class="cate">
                        @foreach ($data as $item)
                            <li><a href="{{ route('category', $item->id) }}"><i class="fa fa-arrow-right" aria-hidden="true"></i>{{ $item->name }}</a></li>
                        @endforeach
					</ul>
				</div>																																												
			</div>
			<div class="col-md-8 products-right">
				<div class="agile_top_brands_grids">
                    @foreach ($product->product as $item)
                        <div class="col-md-4 top_brand_left">
                            <div class="hover14 column">
                                <div class="agile_top_brand_left_grid">
                                    <div class="agile_top_brand_left_grid_pos">
                                        <img src="{{ asset('images/offer.png') }}" alt=" " class="img-responsive" />
                                    </div>
                                    <div class="agile_top_brand_left_grid1">
                                        <figure>
                                            <div class="snipcart-item block">
                                                <div class="snipcart-thumb">
                                                    <a href="product.php?idproduk=3"><img src="{{ asset('storage/'.$item->src_img) }}" width="200px" height="200px"></a>		
                                                    <p>{{ $item->name }}</p>
                                                    <h4>Rp{{ $item->disc }}<span>Rp{{ $item->price }}</span></h4>
                                                </div>
                                                <div class="snipcart-details top_brand_home_details">
                                                    <fieldset>
                                                        <a href="product.php?idproduk=3"><input type="submit" class="button" value="Lihat Produk" /></a>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!--- beverages --->
@endsection