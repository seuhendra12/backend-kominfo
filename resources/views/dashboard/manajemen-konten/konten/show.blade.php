@extends('layouts.main')
@section('title','Show Berita')
@section('container')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
          <div class="col-xxl-6">
            <div class="card card-flush h-md-100">
              <div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                  <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">{{ $kontens -> judul }}</h1>
                  <span class="mt-2">www.kominfo.go.id - {{$kontens->createdDate()}}, {{$kontens->createdTime()}} WIB</span>
                </div>
                <div>
                  <div class="mt-3 mb-5">
                    <div>
                      <img src="{{ asset('media/gambar_cover/' . $kontens->gambar_cover) }}" alt="Gambar" width="500">
                    </div>
                    <table class="fw-bold">
                      <tr>
                        <td class="col-2">Penulis</td>
                        <td>:</td>
                        <td>{{$kontens->penulis}}</td>
                      </tr>
                      <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td>{{$kontens->kategori->name}}</td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                          @if($kontens->status == 'published')
                          <p class="badge badge-success my-auto">Published</p>
                          @elseif($kontens->status == 'inactive')
                          <p class="badge badge-danger my-auto">Inactive</p>
                          @else
                          <p class="badge badge-warning my-auto">Draft</p>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td class="align-top">Isi konten</td>
                        <td class="align-top">:</td>
                        <td>{!! htmlspecialchars_decode($kontens->isi_konten) !!}</td>
                      </tr>
                    </table>
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