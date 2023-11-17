@extends('layouts.login')
@section('title','Login-Dashboard')
@section('container')
<div class="d-flex flex-column flex-root bg-white" id="kt_app_root">
	<div class="d-flex flex-column flex-lg-row flex-column-fluid">
		<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
			<div>
				<img alt="Logo" src="{!! asset('/media/images/logo-kominfo.jpeg') !!}" class="h-60px h-lg-75px" />
			</div>
			<div class="d-flex flex-center flex-column flex-lg-row-fluid">
				<div class="w-lg-500px p-10">
					@if($errors->any())
					@foreach($errors->all() as $err)
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa fa-exclamation-triangle"></i>  {{ $err }}
      				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
       		</div>
					@endforeach
					@endif
					@if(session()->has('errorLogin'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
       			<i class="fa fa-exclamation-triangle"></i>  {{session('errorLogin')}}
          	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </div>
          @endif
					<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="/sesi-login" method="POST">
					@csrf
						<div class="mb-3">
							<h1 class="text-dark fw-bolder mb-3">Masuk</h1>
							<div class="text-gray-500 fw-semibold fs-6">Masuk dengan surel dan kata sandimu</div>
						</div>
						<div class="fv-row mb-8">
						<label class="fw-bolder mb-1">Surel</label>
							<input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-white" value="{{ old('email') ?? session('email') }}" required/>
						</div>
						<div class="fv-row mb-3">
							<div class="row">
								<div class="col-7">
									<label class="fw-bolder mb-1">Kata Sandi</label>
								</div>
								<div class="col-5">
									<a href="#">
										<label class="fw-bolder mb-1 ms-5">Lupa Kata Sandi Anda ?</label>
									</a>
								</div>
							</div>
							<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-password bg-transparent" required />
						</div>
						<div class="row">
							<div class="col-1 mt-1">
							<input type="checkbox" class="form-checkbox mb-4 d-inline">
							</div>
							<div class="col-5">
								<div class="text-gray-500 fw-semibold fs-6"> Tampilkan Kata Sandi</div>
							</div>
						</div>
						<div class="captcha">
              <span>{!! captcha_img() !!}</span>
             		<button type="button" class="btn btn-danger btn-sm ms-4" class="reload" id="reload">
                  &#x21bb;
             		</button>
         		</div>
						<div class="form-group my-2">
                			<input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
            			</div>
      					<br/>
						<div class="d-grid col-3">
							<button type="submit" name="submit" id="kt_sign_in_submit" class="btn btn-primary">
								<span>Masuk</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"style="background-image: url('{!! asset("/media/images/background-login.png") !!}')">
		</div>
	</div>
@endsection