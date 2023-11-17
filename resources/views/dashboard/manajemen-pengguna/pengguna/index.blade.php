@extends('layouts.main')
@section('title','Data Pengguna')
@section('container')

<!-- MAIN CONTENT -->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
	<div class="d-flex flex-column flex-column-fluid">
		<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
			<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
				<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
					<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Pengguna</h1>
				</div>
			</div>
		</div>
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-fluid">
				<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
					<div class="col-xxl-6">
						<div class="card card-flush h-md-100">
							<div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0">
								<div class="row">
									<div class="col-6">
										<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
											<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Pengguna</h1>
											<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
												<li class="breadcrumb-item text-muted">
													<p class="text-muted text-hover-primary">Data Pengguna Kementerian Komunikasi dan Informatika</p>
												</li>
											</ul>
										</div>
									</div>
									<div class="col-6">
										<div class="d-grid d-md-flex justify-content-md-end">
											<a href="data-pengguna/create" class="btn btn-sm fw-bold btn-primary">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-square" viewBox="0 0 16 16">
													<path d="M0 6a6 6 0 1 1 12 0A6 6 0 0 1 0 6z" />
													<path d="M12.93 5h1.57a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1.57a6.953 6.953 0 0 1-1-.22v1.79A1.5 1.5 0 0 0 5.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 4h-1.79c.097.324.17.658.22 1z" />
												</svg>
												Data Baru</a>
										</div>
									</div>
								</div>
								<div>
									@if(session()->has('success'))
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<i class="fa fa-check"></i> {{session('success')}}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
									</div>
									@endif
									@if($errors->any())
									@foreach($errors->all() as $err)
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<i class="fa fa-exclamation-triangle"></i> {{ $err }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
									</div>
									@endforeach
									@endif
									<div class="mt-3">
										<div class="row">
											<div class="col-6">
												<form>
													<div class="d-flex d-inline">
														<span class="fw-bold mt-4">Tampilkan</span>
														<div class="col-2 px-3">
															<input type="number" name="perPage" class="form-control mx-3" value="{{$perPage}}" onchange="this.form.submit()">
														</div>
														<span class="fw-bold mt-4 ms-6">entri</span>
													</div>
												</form>
											</div>
											<div class="col-6 d-grid d-md-flex justify-content-md-end mb-3">
												<form class="form" action="/data-pengguna">
													<div class="input-group input-group-sm" style="width: 150px;">
														<input type="text" name="search" class="form-control float-right rounded-0" id="search" placeholder="Search" value="{{ request('search') }}">
														<div class="input-group-append">
															<button type="submit" class="btn btn-secondary rounded-0">
																<i class="fas fa-search"></i>
															</button>
														</div>
													</div>
												</form>
											</div>
										</div>
										<table class="table table-bordered table-striped">
											<thead class="fw-bold">
												<tr>
													<th>No</th>
													<th>
														<div class="row">
															<div class="col-6">Nama</div>
															<div class="col-6 d-grid d-md-flex justify-content-md-end">
																<a href="?sort={{ $sort == 'asc' ? 'desc' : 'asc' }}">
																	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
																		<path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
																	</svg>
																</a>
															</div>
														</div>
													</th>
													<th>Surel</th>
													<th>Role</th>
													<th>Level Akses</th>
													<th>Login Terakhir</th>
													<th>Aktif</th>
												</tr>
											</thead>
											<tbody>
												@forelse($users as $user)
												<tr>
													<td>{{$loop->iteration}}</td>
													<td>{{$user->name}}</td>
													<td>{{$user->email}}</td>
													<td>{{$user->roles->pluck('name')->implode(', ')}}</td>
													<td>{{$user->level_akses}}</td>
													<td>{{ optional($user->loginHistories->first())->created_at }}</td>
													<td>
														<form action="data-pengguna/{{$user->id}}" method="POST">
															@method('PATCH')
															@csrf
															<label class="form-check form-switch form-check-custom form-check-solid">
																<input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $user['is_active'] == 1 ? 'checked' : '' }} onchange="this.form.submit()">
															</label>
														</form>
													</td>
												</tr>
												@empty
												<td colspan="7" class="text-center bg-danger">-- Data Tidak Ada --</td>
												@endforelse
											</tbody>
										</table>
									</div>
								</div>
								<div class="mb-5">
									{{$users->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
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