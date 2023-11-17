@extends('layouts.main')
@section('title','Tambah Data Agenda')
@section('container')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Agenda</h1>
        </div>
      </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
          <div class="col-xxl-6">
            <div class="row">
              <div class="col-8">
                <div class="card card-flush h-md-100">
                  <div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0">
                    <div>
                      @if($errors->any())
                      @foreach($errors->all() as $err)
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-triangle"></i> {{ $err }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                      </div>
                      @endforeach
                      @endif
                      <form class="form" action="{{url('agenda')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Judul</span>
                          </label>
                          <input type="text" class="form-control @error('judul') is-invalid @enderror" placeholder="Tulis judul di sini" name="judul" value="{{old('judul')}}" />
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Slug <span class="text-primary">(Optional)</span></span>
                          </label>
                          <input type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="Tulis slug di sini. Contoh: kominfo-blokir-situs-judi" name="slug" value="{{old('slug')}}" />
                          <p class="fw-semibold text-secondary">Slug bisa dikosongkan. Jika kosong akan dibuat otomatis dari judul</p>
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label for="unitKerja" class="fs-6 fw-semibold mb-2 required">Unit Kerja</label>
                          <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Unit Kerja" name="unitKerja" id="unitKerja">
                            <option value="">Select Unit Kerja</option>
                            @foreach ($unitKerjas as $unitKerja)
                            @if (old('unitKerja_id')==$unitKerja->id)
                            <option value="{{$unitKerja->id}}" selected>{{$unitKerja->name}}</option>
                            @else
                            <option value="{{$unitKerja->id}}">{{$unitKerja->name}}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                        <div class="row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Tanggal Agenda</label>
                          <div class="col-5 ms-5">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">Tanggal Mulai :</label>
                            <div class="d-flex flex-column mb-6 fv-row">
                              <input type="datetime-local" class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" value="{{old('tanggal_mulai')}}" />
                            </div>
                          </div>
                          <div class="col-5">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">Tanggal Selesai :</label>
                            <div class="d-flex flex-column mb-6 fv-row">
                              <input type="datetime-local" class="form-control @error('tanggal_selesai') is-invalid @enderror" name="tanggal_selesai" value="{{old('tanggal_selesai')}}" />
                            </div>
                          </div>
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Lokasi</span>
                          </label>
                          <input type="text" class="form-control @error('lokasi') is-invalid @enderror" placeholder="Tulis lokasi di sini" name="lokasi" value="{{old('lokasi')}}" />
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Deskripsi <span class="text-primary">(Optional)</span></span>
                          </label>
                          <textarea name="deskripsi" id="deskripsi" cols="50" rows="10" class="form-control @error('deskripsi') is-invalid @enderror">{{old('deskripsi')}}</textarea>
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Tautan <span class="text-primary">(Optional)</span></span>
                          </label>
                          <input type="text" class="form-control @error('tautan') is-invalid @enderror" placeholder="Tulis tautan di sini" name="tautan" value="{{old('tautan')}}" />
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Email <span class="text-primary">(Optional)</span></span>
                          </label>
                          <input type="text" class="form-control @error('surel') is-invalid @enderror" placeholder="Tulis email di sini" name="surel" value="{{old('surel')}}" />
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card card-flush">
                  <div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0">
                    <div>
                      <div class="d-flex flex-column mb-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                          <span>Penulis</span>
                        </label>
                        <input type="text" class="form-control bg-secondary" name="penulis" value="{{Auth::user()->name}}" readonly />
                      </div>
                      <div class="d-flex flex-column mb-6 fv-row">
                        <label for="status" class="fs-6 fw-semibold mb-2 required">Status</label>
                        <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Status" name="status" id="status">
                          <option value="">Select status</option>
                          <option value="published">Published</option>
                          <option value="inactive">Inactive</option>
                          <option value="draft">Draft</option>
                        </select>
                      </div>
                      <div class="d-flex flex-column mb-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                          <span>Gambar</span>
                        </label>
                        <div class="col-lg-8">
                          <div class="image-input image-input-outline" data-kt-image-input="true">
                            <div class="image-input-wrapper w-175px h-125px" style="background-image: url('/media/images/blank.jpg')"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload gambar">
                              <i class="bi bi-pencil-fill fs-7"></i>
                              <input type="file" name="gambar" accept=".png, .jpg, .jpeg" value="{{old('gambar')}}" class="@error('gambar') is-invalid @enderror" required />
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal gambar">
                              <i class="bi bi-x fs-2"></i>
                            </span>
                          </div>
                        </div>
                        <span class="fw-bold text-secondary">File yang diizinkan adalah jpeg, jpg, dan png dengan ukuran maksimal 1 Mb</span>
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
  </div>
</div>

@endsection