@extends('layouts.main')
@section('title','Data Agenda')
@section('container')

<!-- MAIN CONTENT -->
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
            <div class="card card-flush h-md-100">
              <div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0">
                <div class="row">
                  <div class="col-6">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Agenda</h1>
                      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                          <p class="text-muted text-hover-primary">Data Agenda Kementerian Komunikasi dan Informatika</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="d-grid d-md-flex justify-content-md-end">
                      <a href="agenda/create" class="btn btn-sm fw-bold btn-primary">
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
                  <div class="menu-active-bg">
                    <div class="d-flex w-100">
                      <ul class="nav nav-stretch nav-line-tabs fw-bold fs-6 flex-nowrap">
                        <li class="nav-item">
                          <a class="nav-link active text-active-primary" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_menu_pages_pages">
                            <span class="me-3">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-range-fill" viewBox="0 0 16 16">
                                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 7V5H0v5h5a1 1 0 1 1 0 2H0v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9h-6a1 1 0 1 1 0-2h6z" />
                              </svg>
                            </span>
                            <span class="mt-1">
                              Kalender
                            </span>
                          </a>
                        </li>
                        <li class="nav-item mx-lg-1">
                          <a class="nav-link py-3 py-lg-6 text-active-primary" href="#" data-bs-toggle="tab" data-bs-target="#kt_app_header_menu_pages_account">
                            <span class="me-3">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
                              </svg>
                            </span>
                            <span class="mt-1">
                              Tabel
                            </span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane active w-lg-1000px" id="kt_app_header_menu_pages_pages">
                      <div class="card-body">
                        <!--begin::Calendar-->
                        <div id="calendar"></div>
                        <!--end::Calendar-->
                      </div>
                      <div>
                        <div class="card-body">
                          <table class="table table-bordered table-striped">
                            <thead class="fw-bold">
                              <tr>
                                <th scope="col" class="w-25">
                                  <div class="row">
                                    <div class="col-6">Unit Kerja</div>
                                    <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                      <a href="?sort={{ $sort == 'asc' ? 'desc' : 'asc' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                        </svg>
                                      </a>
                                    </div>
                                  </div>
                                </th>
                                <th scope="col">Label Warna</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($unitKerjas as $unitKerja)
                              <tr>
                                <td class="align-middle col-10">{{$unitKerja->name}}</td>
                                <td class="align-middle">
                                  <span class="badge" style="background-color: <?php echo $unitKerja->label_warna ?>">{{$unitKerja->label_warna}}</span>
                                </td>
                              </tr>
                              @empty
                              <td colspan="2" class="text-center bg-danger">-- Data Tidak Ada --</td>
                              @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane w-lg-1000px" id="kt_app_header_menu_pages_account">
                      <div class="row mt-5">
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
                          <form class="form" action="/agenda">
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
                            <th scope="col">Unit Kerja</th>
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">Tanggal Selesai</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Tautan</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($agendas as $agenda)
                          <tr>
                            <td class="align-middle">{{$loop->iteration}}</td>
                            <td class="align-middle">{{$agenda->judul}}</td>
                            <td class="align-middle">{{ optional($agenda->unitKerja)->name }}</td>
                            <td class="align-middle">{{$agenda->tanggal_mulai}}</td>
                            <td class="align-middle">{{$agenda->tanggal_selesai}}</td>
                            <td class="align-middle">{{$agenda->lokasi}}</td>
                            <td class="align-middle">{{$agenda->tautan}}</td>
                            <td>
                              <a href="agenda/{{$agenda->id}}/edit" class="btn btn-yellow btn-sm mb-3">
                                <span>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                  </svg>
                                </span>
                              </a>
                              <a href="#" class="btn btn-red btn-sm" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal" data-agenda-id="{{ $agenda->id }}">
                                <span>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                  </svg>
                                </span>
                              </a>
                            </td>
                          </tr>
                          @empty
                          <td colspan="8" class="text-center bg-danger">-- Data Tidak Ada --</td>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                    <div class="mb-5">
                      {{$agendas->appends(['perPage' => $perPage])->links('pagination::bootstrap-5')}}
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
  <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirm-delete-modal-label">Hapus agenda</h5>
          <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
            <span class="svg-icon svg-icon-1">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
              </svg>
            </span>
          </div>
        </div>
        <div class="modal-body">
          Apakah kamu yakin ingin menghapus agenda ini ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form action="{{ url('agenda', '__agenda_id') }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div id="eventModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalTitle"></h5>
          <button type="button" class="btn btn-sm" data-dismiss="modal" aria-label="Close">
            <div class="btn btn-sm btn-icon btn-active-color-primary" aria-hidden="true">
              <span class="svg-icon svg-icon-1">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                  <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                </svg>
              </span>
            </div>
          </button>
        </div>
        <div class="modal-body">
          <div id="eventModalImageContainer" class="text-center mb-3">
            <img id="eventModalImage" src="" alt="" style="max-width: 300px; max-height: 300px;">
          </div>

          <table>
            <tr>
              <td>Tanggal Mulai</td>
              <td>:</td>
              <td id="eventModalStart"></td>
            </tr>
            <tr>
              <td>Tanggal Selesai</td>
              <td>:</td>
              <td id="eventModalEnd"></td>
            </tr>
            <tr>
              <td>Deskripsi</td>
              <td>:</td>
              <td id="eventModalDescription"></td>
            </tr>
            <tr>
              <td>Lokasi</td>
              <td>:</td>
              <td id="eventModalLocation"></td>
            </tr>
            <tr>
              <td>Tautan</td>
              <td>:</td>
              <td id="eventModalLink"></td>
            </tr>
            <tr>
              <td>Surel</td>
              <td>:</td>
              <td id="eventModalEmail"></td>
            </tr>
            <tr>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
<!-- <script src="{!! asset('/plugins/custom/fullcalendar/fullcalendar.bundle.js') !!}"></script> -->
<script src="{!! asset('/plugins/custom/datatables/datatables.bundle.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script>
  var jq = jQuery.noConflict();
  jq(document).ready(function() {
    var calendar = jq('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      navLinks: true,
      editable: true,
      selectable: true, // Mengaktifkan fungsi selectable
      events: "/agenda",
      displayEventTime: false,
      eventRender: function(event, element, view) {
        if (event.allDay === 'true') {
          event.allDay = true;
        } else {
          event.allDay = false;
        }

        // Periksa apakah event jatuh pada hari ini
        var today = moment().startOf('day');
        var eventStart = moment(event.start).startOf('day');
        if (eventStart.isSame(today)) {
          // Tampilkan notifikasi untuk event yang jatuh pada hari ini
          element.append('<div class="today-event-notification">Hari ini</div>');
        }
      },
      eventClick: function(event) {
        // Mengisi data event pada modal
        jq('#eventModalTitle').text(event.title);
        jq('#eventModalStart').text(moment(event.start).locale('id').format('D MMMM YYYY[,] [pukul] HH:mm') + ' WIB');
        jq('#eventModalEnd').text(moment(event.end).locale('id').format('D MMMM YYYY[,] [pukul] HH:mm') + ' WIB');
        var description = event.description;
        description = description.replace(/<\/?p>/g, '');
        jq('#eventModalDescription').html(description);
        jq('#eventModalImage').attr('src', event.gambar);
        jq('#eventModalLocation').text(event.location);
        jq('#eventModalLink').text(event.link);
        jq('#eventModalEmail').text(event.email);

        // Menampilkan modal
        jq('#eventModal').modal('show');
      },
      select: function(start, end) {
        // Mengisi tanggal awal dan tanggal akhir pada form input
        jq('#inputStartDate').val(start.format('YYYY-MM-DD'));
        jq('#inputEndDate').val(end.format('YYYY-MM-DD'));

        // Menampilkan modal untuk menambahkan event baru
        jq('#addEventModal').modal('show');

        // Membersihkan seleksi setelah memilih rentang tanggal
        calendar.fullCalendar('unselect');
      }
    });
  });
</script>

@endsection