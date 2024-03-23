@extends('layouts.login-layout')

@section('breadcrumb')
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
                <li class="active">Halaman Login</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
@endsection

@section('main')
    <!-- login -->
	<div class="login">
		<div class="container">
			<h2>Masuk</h2>

			<div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
                @if (session()->has('alert'))
                    <div class='alert {{ session('alert') }}'>
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
				<form method="POST" action="login">
                    @csrf
                    <input type="text" name="email" placeholder="Email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
					<input type="password" name="password" placeholder="Password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
					<input type="submit" value="Masuk">
				</form>
			</div>
			<h4>Belum terdaftar?</h4>
			<p><a href="{{ route('register') }}">Daftar Sekarang</a></p>
		</div>
	</div>
	<!-- //login -->
@endsection