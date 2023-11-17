@extends('layouts.main')
@section('title','Ubah Data Konten')
@section('container')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Konten</h1>
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
                      <form class="form" action="/konten/{{$kontens->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Judul</span>
                          </label>
                          <input type="text" class="form-control" placeholder="Tulis judul di sini. Contoh: Kominfo Blokir Ratusan Ribu Situs Judi Online" name="judul" value="{{old('judul',$kontens->judul)}}" />
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Judul Eng <span class="text-primary">(Optional)</span></span>
                          </label>
                          <input type="text" class="form-control" placeholder="Tulis judul bahasa inggris di sini" name="judul_eng" value="{{old('judul_eng',$kontens->judul_eng)}}" />
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Slug <span class="text-primary">(Optional)</span></span>
                          </label>
                          <input type="text" class="form-control" placeholder="Tulis slug di sini. Contoh:kominfo-blokir-situs-judi" name="slug" value="{{old('slug',$kontens->slug)}}" />
                          <p class="fw-bold text-secondary">Slug bisa dikosongkan. Jika kosong akan dibuat otomatis dari judul.</p>
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Slug Eng <span class="text-primary">(Optional)</span></span>
                          </label>
                          <input type="text" class="form-control" placeholder="Tulis slug bahasa inggris di sini." name="slug_eng" value="{{old('slug_eng',$kontens->slug_eng)}}" />
                          <p class="fw-bold text-secondary">Slug bisa dikosongkan. Jika kosong akan dibuat otomatis dari judul.</p>
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Kutipan <span class="text-primary">(Optional)</span></span>
                          </label>
                          <textarea name="kutipan" id="" cols="20" rows="4" class="form-control" placeholder="Tulis kutipan di sini.">{{old('kutipan',$kontens->kutipan)}}</textarea>
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Kutipan Eng <span class="text-primary">(Optional)</span></span>
                          </label>
                          <textarea name="kutipan_eng" id="" cols="20" rows="4" class="form-control" placeholder="Tulis kutipan bahasa inggris di sini.">{{old('kutipan_eng',$kontens->kutipan_eng)}}</textarea>
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Isi Konten</span>
                          </label>
                          <textarea name="isi_konten" id="isi_konten" cols="20" rows="4" class="form-control">{{old('isi_konten',$kontens->isi_konten)}}</textarea>
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Isi Konten Eng<span class="text-primary">(Optional)</span></span>
                          </label>
                          <textarea name="isi_konten_eng" id="isi_konten_eng" cols="20" rows="4" class="form-control">{{old('isi_konten_eng',$kontens->isi_konten_eng)}}</textarea>
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label for="galeri" class="fs-6 fw-semibold mb-2">Galeri</label>
                          <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Galeri" name="galeri" id="galeri">
                            <option value="">Select Galeri</option>
                            @foreach ($galeris as $galeri)
                            @if (old('galeri_id',$kontens->galeri_id)==$galeri->id)
                            <option value="{{$galeri->id}}" selected>{{$galeri->name}}</option>
                            @else
                            <option value="{{$galeri->id}}">{{$galeri->name}}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                        <div class="d-flex flex-column mb-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span>Lampiran</span>
                          </label>
                          <input type="file" class="form-control" name="files[]" accept="image/*">
                          <p class="fw-bold text-secondary">File yang diizinkan adalah jpeg, jpg, png, pdf, zip, dan rar dengan ukuran maksimal 5 Mb.</p>
                          @if ($kontens->lampiran)
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
                        <label for="kategori" class="fs-6 fw-semibold mb-2">Kategori</label>
                        <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Kategori" name="kategori" id="kategori">
                          <option value="">Select kategori</option>
                          @foreach ($kategoris as $kategori)
                          @if (old('kategori_id',$kontens->kategori_id)==$kategori->id)
                          <option value="{{$kategori->id}}" selected>{{$kategori->name}}</option>
                          @else
                          <option value="{{$kategori->id}}">{{$kategori->name}}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="d-flex flex-column mb-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                          <span>Tag <span class="text-primary">(Optional)</span></span>
                        </label>
                        <input type="text" class="form-control" name="tag" value="{{old('tag',$kontens->tag)}}" />
                      </div>
                      <div class="d-flex flex-column mb-6 fv-row">
                        <label for="status" class="fs-6 fw-semibold mb-2">Status</label>
                        <select class="form-control" data-control="select2" data-hide-search="true" data-placeholder="Pilih Status" id="status" name="status">
                          <option value="published" {{ $kontens->status == 'published' ? 'selected' : '' }}>Published</option>
                          <option value="inactive" {{ $kontens->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                          <option value="draft" {{ $kontens->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                      </div>
                      <div class="row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">Diterbitkan pada <span class="text-primary">(Optional)</span></label>
                        <div class="col-6">
                          <div class="d-flex flex-column mb-6 fv-row">
                            <input type="date" class="form-control" name="tanggal_terbit" value="{{old('tanggal_terbit',$kontens->tanggal_terbit)}}" />
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="d-flex flex-column mb-6 fv-row">
                            <input type="time" class="form-control" name="jam_terbit" value="{{old('jam_terbit',$kontens->jam_terbit)}}" />
                          </div>
                        </div>
                      </div>
                      <div class="d-flex flex-column mb-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                          <span>Gambar Cover Berita</span>
                        </label>
                        <div class="col-lg-8">
                          <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('/media/images/blank.jpg')">
                            <div class="image-input-wrapper w-175px h-125px" style="background-image: url('/media/gambar_cover/{{ $kontens->gambar_cover }}')"></div>
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
                        <span class="fw-bold text-secondary">File yang diizinkan adalah jpeg, jpg, dan png dengan ukuran maksimal 1 Mb</span>
                      </div>
                      <div class="d-flex flex-column mb-6 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                          <span>Gambar Slider</span>
                        </label>
                        <div class="col-lg-8">
                          <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('/media/images/blank.jpg')">
                            <div class="image-input-wrapper w-175px h-125px" style="background-image: url('/media/gambar_slider/{{ $kontens->gambar_slider }}')"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload gambar">
                              <i class="bi bi-pencil-fill fs-7"></i>
                              <input type="file" name="gambar_slider" accept=".png, .jpg, .jpeg" value="{{old('gambar_slider')}}"/>
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal gambar">
                              <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus gambar">
                              <i class="bi bi-x fs-2"></i>
                            </span>
                          </div>
                        </div>
                        <span class="fw-bold text-secondary">File yang diizinkan adalah jpeg, jpg, dan png dengan ukuran maksimal 1 Mb</span>
                      </div>
                      <div class="mb-6">
                        <span class="form-check-label fw-semibold text-muted mb-2">Featured</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"></i>
                        <label class="form-check form-switch form-check-custom form-check-solid">
                          <input name="featured" class="form-check-input" type="checkbox" value="1" {{ $kontens['featured'] == 1 ? 'checked' : '' }} />
                        </label>
                      </div>
                      <div class="mb-6">
                        <span class="form-check-label fw-semibold text-muted mb-2">Featured Eng</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"></i>
                        <label class="form-check form-switch form-check-custom form-check-solid">
                          <input name="featured_eng" class="form-check-input" type="checkbox" value="1" {{ $kontens['featured_eng'] == 1 ? 'checked' : '' }} />
                        </label>
                      </div>
                      <div class="mb-6">
                        <span class="form-check-label fw-semibold text-muted mb-2">Sticky</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"></i>
                        <label class="form-check form-switch form-check-custom form-check-solid">
                          <input name="sticky" class="form-check-input" type="checkbox" value="1" {{ $kontens['sticky'] == 1 ? 'checked' : '' }}/>
                        </label>
                      </div>
                      <div class="mb-6">
                        <span class="form-check-label fw-semibold text-muted mb-2">Sticky Eng</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"></i>
                        <label class="form-check form-switch form-check-custom form-check-solid">
                          <input name="sticky_eng" class="form-check-input" type="checkbox" value="1" {{ $kontens['sticky_eng'] == 1 ? 'checked' : '' }}/>
                        </label>
                      </div>
                      <div class="mb-6">
                        <span class="form-check-label fw-semibold text-muted mb-2">Is GPR</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"></i>
                        <label class="form-check form-switch form-check-custom form-check-solid">
                          <input name="is_gpr" class="form-check-input" type="checkbox" value="1" {{ $kontens['is_gpr'] == 1 ? 'checked' : '' }}/>
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
  </div>
</div>

@endsection