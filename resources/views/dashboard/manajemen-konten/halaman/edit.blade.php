@extends('layouts.main')
@section('title','Ubah Data Halaman')
@section('container')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Halaman</h1>
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
                      <form class="form" action="/halaman/{{$halaman->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Judul</span>
                          </label>
                          <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{old('judul',$halaman->judul)}}" />
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Isi Konten</span>
                          </label>
                          <textarea name="isi_konten" id="isi_konten" cols="50" rows="10" class="form-control @error('isi_konten') is-invalid @enderror">{{old('isi_konten',$halaman->isi_konten)}}</textarea>
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
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                          <span>Tag <span class="text-primary">(Optional)</span></span>
                        </label>
                        <input type="text" class="form-control @error('tag') is-invalid @enderror" name="tag" value="{{old('tag',$halaman->tag)}}" />
                      </div>
                      <div class="d-flex flex-column mb-6 fv-row">
                        <label for="status" class="fs-6 fw-semibold mb-2">Status</label>
                        <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Status" name="status" id="status">
                          <option value="published" {{ $halaman->status == 'published' ? 'selected' : '' }}>Published</option>
                          <option value="inactive" {{ $halaman->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                          <option value="draft" {{ $halaman->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                      </div>
                      <div class="row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">Diterbitkan pada <span class="text-primary">(Optional)</span></label>
                        <div class="col-6">
                          <div class="d-flex flex-column mb-6 fv-row">
                            <input type="date" class="form-control @error('tanggal_terbit') is-invalid @enderror" name="tanggal_terbit" value="{{old('tanggal_terbit',$halaman->tanggal_terbit)}}" />
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="d-flex flex-column mb-6 fv-row">
                            <input type="time" class="form-control @error('jam_terbit') is-invalid @enderror" name="jam_terbit" value="{{old('jam_terbit',$halaman->jam_terbit)}}" />
                          </div>
                        </div>
                      </div>
                      <div class="d-flex flex-column mb-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                          <span>Gambar Cover</span>
                        </label>
                        <div class="col-lg-8">
                          <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('/media/images/blank.jpg')">
                            <div class="image-input-wrapper w-175px h-125px" style="background-image: url('/media/gambar_cover/{{ $halaman->gambar_cover }}')"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload gambar">
                              <i class="bi bi-pencil-fill fs-7"></i>
                              <input type="file" name="gambar_cover" accept=".png, .jpg, .jpeg" value="{{old('gambar_cover')}}"/>
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal gambar">
                              <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus gambar">
                              <i class="bi bi-x fs-2"></i>
                            </span>
                          </div>
                        </div>
                        </div>
                        <span class="fw-bold text-secondary">File yang diizinkan adalah jpeg, jpg, dan png dengan ukuran maksimal 1 Mb</span>
                      </div>
                      <div class="d-flex flex-column mb-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                          <span>Lampiran</span></span>
                        </label>
                        <input type="file" class="form-control @error('lampiran') is-invalid @enderror" placeholder="Pilih file" name="files[]" value="{{old('lampiran')}}" multiple  />
                        <p class="fw-bold text-secondary">File yang diizinkan adalah jpeg, jpg, png, pdf, zip, dan rar dengan ukuran maksimal 5 Mb.</p>
                        @if ($halaman->lampiran)
                          @foreach ($files as $file)
                          @if (pathinfo($file, PATHINFO_EXTENSION) == 'pdf')
                          <div class="d-flex d-inline">
                            <img src="{{ asset('media/images/icon_pdf.png') }}" class="img-thumbnail" width="30">
                            <div class="my-auto ms-3">{{$file}}</div>
                          </div>
                          @elseif (pathinfo($file, PATHINFO_EXTENSION) == 'zip')
                          <div class="d-flex d-inline">
                            <img src="{{ asset('media/images/icon_zip.png') }}" class="img-thumbnail" width="30">
                            <div class="my-auto ms-3">{{$file}}</div>
                          </div>
                          @elseif (pathinfo($file, PATHINFO_EXTENSION) == 'rar')
                          <div class="d-flex d-inline">
                            <img src="{{ asset('media/images/icon_rar.png') }}" class="img-thumbnail" width="30">
                            <div class="my-auto ms-3">{{$file}}</div>
                          </div>
                          @else
                          <img src="{{ asset('media/lampiran/'.$file) }}" class="img-thumbnail" width="200">
                          @endif
                          @endforeach
                          @endif
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