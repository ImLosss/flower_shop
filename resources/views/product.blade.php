@extends('layouts.login-layout')

@section('breadcrumb')
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
                <li class="active">Product</li>
                <li class="active">{{ $product->name }}</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
@endsection

@section('main')
<div class="products">
    <div class="container">
        <div class="agileinfo_single">

            <div class="col-md-4 agileinfo_single_left">
                <img id="example" src="{{ asset('storage/'.$product->src_img) }}" alt=" " class="img-responsive">
            </div>
            <div class="col-md-8 agileinfo_single_right">
                <h2>{{ $product->name }}</h2>
                <div class="rating1">
                    <span class="starRating">
                        @for ($i = 1; $i <= $product->rate; $i++)
                            <i class="fa fa-star blue-star" aria-hidden="true"></i>
                        @endfor
                    </span>
                </div>
                <div class="w3agile_description">
                    <h4>Deskripsi :</h4>
                    <p>{{ $product->description }}</p>
                </div>
                <div class="snipcart-item block">
                    <div class="snipcart-thumb agileinfo_single_right_snipcart">
                        <h4 class="m-sing">Rp{{ $product->disc }}<span>Rp{{ $product->price }}</span></h4>
                    </div>
                    <div class="snipcart-details agileinfo_single_right_details">
                        <form action="{{ route('addcart') }}" method="post">
                            @csrf
                            <fieldset>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="price" value="{{ $product->disc }}">
                                <input type="submit" value="Add to cart" class="button" @role('admin') disabled @endrole>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
@endsection