@extends('layouts.main')
@section('title','Data Histori')
@section('container')

<!-- MAIN CONTENT -->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Histori</h1>
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
                      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Histori</h1>
                      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                          <p class="text-muted text-hover-primary">Data Histori Kementerian Komunikasi dan Informatika</p>
                        </li>
                      </ul>
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
                        <form class="form" action="/kontenHistoris">
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
                          <th scope="col">No</th>
                          <th scope="col" class="w-25">
                            <div class="row">
                              <div class="col-6">Judul</div>
                              <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                <a href="?sort={{ $sort == 'asc' ? 'desc' : 'asc' }}">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </th>
                          <th scope="col">Kategori</th>
                          <th scope="col">Dihapus</th>
                          <th scope="col">Status</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($konten_historis as $kontenHistori)
                        <tr>
                          <td class="align-middle">{{$loop->iteration}}</td>
                          <td class="align-middle">{{$kontenHistori->konten->judul}}</td>
                          <td class="align-middle">{{$kontenHistori->konten->kategori->name}}</td>
                          <td class="align-middle">{{$kontenHistori->konten->deletedDate()}}, {{$kontenHistori->konten->deletedTime()}} WIB</td>
                          <td class="align-middle">
                            @if($kontenHistori->konten->status == 'published')
                            <p class="badge badge-success my-auto">Published</p>
                            @elseif($kontenHistori->konten->status == 'inactive')
                            <p class="badge badge-danger my-auto">Inactive</p>
                            @else
                            <p class="badge badge-warning my-auto">Draft</p>
                            @endif
                          </td>
                          <td>
                            <a href="konten-histori/{{$kontenHistori->id}}" class="btn btn-purple btn-sm" title="Detail" data-bs-toggle="tooltip">
                              <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye icon-large" viewBox="0 0 16 16">
                                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>
                              </span>
                            </a>
                            <a href="restore/{{$kontenHistori->konten_id}}" class="btn btn-green btn-sm" title="Pulihkan" data-bs-toggle="tooltip">
                              <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise icon-large" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                                  <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                                </svg>
                              </span>
                            </a>
                          </td>
                        </tr>
                        @empty
                        <td colspan="6" class="text-center bg-danger">-- Data Tidak Ada --</td>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="mb-5">
                  {{$konten_historis->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
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