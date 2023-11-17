@extends('layouts.main')
@section('title','Tambah Data Kategori')
@section('container')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
	<div class="d-flex flex-column flex-column-fluid">
		<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
			<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
				<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
					<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Kategori</h1>
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
									<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Tambah Data Kategori</h1>
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
									<form class="form" action="{{url('kategoris')}}" method="POST">
										@csrf
										<div class="d-flex flex-column mb-8 fv-row">
											<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
												<span class="required">Nama</span>
											</label>
											<input type="text" class="form-control" placeholder="Masukkan Nama Kategori" name="name" />
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