@extends('layouts.main')
@section('title','Tambah Data Pengguna')
@section('container')

<!-- MAIN CONTENT -->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
	<div class="d-flex flex-column flex-column-fluid">
		<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
			<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
				<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
					<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Role</h1>
				</div>
			</div>
		</div>
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-fluid">
				<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
					<div class="col-xxl-6">
						<div class="card card-flush h-md-100">
							<div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0">
								<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
									<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Tambah Data Pengguna</h1>
								</div>
								<hr>
								<div>
									@if($errors->any())
									@foreach($errors->all() as $err)
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<i class="fa fa-exclamation-triangle"></i> {{ $err }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
									</div>
									@endforeach
									@endif
									<form class="form" action="{{url('data-pengguna')}}" method="POST">
										@csrf
										<div class="d-flex flex-column mb-8 fv-row">
											<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
												<span class="required">Nama Lengkap</span>
											</label>
											<input type="text" class="form-control" placeholder="Masukkan Nama Lengkap" name="name" />
										</div>
										<div class="d-flex flex-column mb-8 fv-row">
											<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
												<span class="required">Surel</span>
											</label>
											<input type="email" class="form-control" placeholder="Masukkan Alamat Email" name="email" />
										</div>
										<div class="g-9 mb-8">
											<label class="required fs-6 fw-semibold mb-2">Role</label>
											<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Role Pengguna" name="roles">
												<option value="">Select role...</option>
												@foreach ($roles as $role)
												<option value="{{$role->id}}">{{$role->name}}</option>
												@endforeach
											</select>
										</div>
										<div class="g-9 mb-8">
											<label class="required fs-6 fw-semibold mb-2">Level Akses</label>
											<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Level Akses Pengguna" name="level_akses">
												<option value="">Select role...</option>
												<option value="Editor">Editor</option>
												<option value="Kontributor">Contributor</option>
											</select>
										</div>
										<div class="d-flex flex-column mb-8 fv-row">
											<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
												<span class="required">Kata Sandi</span>
											</label>
											<input type="password" class="form-password" placeholder="Minimal 10 karakter" name="password" />
										</div>
										<div class="d-flex flex-column mb-6 fv-row">
											<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
												<span class="required">Konfirmasi Kata Sandi</span>
											</label>
											<input type="password" class="form-password" placeholder="Ketik kata sandi lagi di sini" name="password_confirmation" />
										</div>
										<div class="row">
											<div class="col-auto mt-1">
												<input type="checkbox" class="form-checkbox mb-4 d-inline">
											</div>
											<div class="col-10">
												<div class="fw-semibold fs-6"> Tampilkan Kata Sandi</div>
											</div>
										</div>
										<div class="d-flex flex-column mb-6 fv-row">
											<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
												<span>Satuan Kerja <span class="text-primary">(Optional)</span> </span>
											</label>
											<input type="text" class="form-control" placeholder="Tulis satuan kerja disini" name="satuan_kerja" />
										</div>
										<div class="d-flex flex-stack mb-8">
											<label class="form-check form-switch form-check-custom form-check-solid">
												<input name="is_active" class="form-check-input" type="checkbox" value="1" />
												<span class="form-check-label fw-semibold text-muted">Aktif</span>
											</label>
										</div>
										<div class="mb-10">
											<button type="submit" class="btn btn-primary btn-sm">
												<span class="indicator-label">Simpan</span>
												<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											</button>
											<button type="reset" class="btn btn-secondary me-5 btn-sm">Batal</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection