@extends('layouts.login-layout')

@section('breadcrumb')
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
                <li class="active">Product</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
@endsection

@section('main')
    <!-- top-brands -->
	<div class="top-brands">
		<div class="container">
			<h2>Produk Kami</h2>
			<div class="grid_3 grid_5">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="expeditions" aria-labelledby="expeditions-tab">
							<div class="agile-tp">
								<h5>Penawaran Terbaik Minggu Ini @auth
                                   untukmu, {{ Auth::user()->name }} 
                                @endauth
								</h5>
							</div>
							<div class="agile_top_brands_grids">
                                @foreach ($data as $category)
                                    @foreach ($category->product as $item)
                                        <div class="col-md-4 top_brand_left" style="padding-bottom: 10p">
                                            <div class="hover14 column">
                                                <div class="agile_top_brand_left_grid">
                                                    <div class="agile_top_brand_left_grid_pos">
                                                        <img src="{{ asset('images/offer.png') }}" alt=" " class="img-responsive" />
                                                    </div>
                                                    <div class="agile_top_brand_left_grid1">
                                                        <figure>
                                                            <div class="snipcart-item block">
                                                                <div class="snipcart-thumb">
                                                                    <a href="product.php?idproduk=1"><img title=" " alt=" " src="{{ asset('storage/'.$item->src_img) }}" width="200px" height="200px" /></a>
                                                                    <p>{{ $item->name }}</p>
                                                                    <div class="stars">
                                                                        @for ($i = 1; $i <= $item->rate; $i++)
                                                                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                        @endfor
                                                                    </div>
                                                                    <h4>Rp. {{ $item->disc }}<span>{{ $item->price }}</span></h4>
                                                                </div>
                                                                <div class="snipcart-details top_brand_home_details">
                                                                    <fieldset>
                                                                        <a href="{{ route('product', $item->id) }}"><input type="submit" class="button" value="Lihat Produk" /></a>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </figure>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                                
								<div class="clearfix"> </div>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //top-brands -->
@endsection