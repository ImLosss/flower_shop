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
    <!-- register -->
	<div class="register">
		<div class="container">
			<h2>Daftar Disini</h2>
			<div class="login-form-grids">
				<h5>Informasi Pribadi</h5>
				<form method="post" action="{{ route('register') }}">
					@csrf
					<input type="text" name="name" placeholder="Nama Lengkap" required>
					<input type="text" name="notelp" placeholder="Nomor Telepon" required>
					<input type="text" name="alamat" placeholder="Alamat Lengkap" required>

					@error('nama')
						<small class="text-danger">{{ $message }}</small>
					@enderror
					@error('notelp')
						<small class="text-danger">{{ $message }}</small>
					@enderror
					@error('alamat')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				
					<h6>Informasi Login</h6>
					
					<input type="email" name="email" placeholder="Email" required="@">
					<input type="password" name="password" placeholder="Password" required>

					@error('email')
						<small class="text-danger">{{ $message }}</small>
					@enderror
					@error('password')
						<small class="text-danger">{{ $message }}</small>
					@enderror

					<input type="submit" value="Daftar">
				</form>
			</div>
			<div class="register-home">
				<a href="{{ route('home') }}">Batal</a>
			</div>
		</div>
	</div>
    <!-- //register -->
@endsection