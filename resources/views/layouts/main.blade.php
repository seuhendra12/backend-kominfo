<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', 'Dashboard')</title>
	<!-- CSS -->
	<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css">
	<!-- <link href="{!! asset('/plugins/custom/fullcalendar/fullcalendar.bundle.css') !!}" rel="stylesheet" type="text/css" /> -->
	<link href="{!! asset('/plugins/custom/datatables/datatables.bundle.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('/plugins/global/plugins.bundle.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('/css/style.bundle.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('/css/loading.css') !!}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<style>
		.table-striped tbody tr:nth-of-type(odd) {
			background-color: #A1A5B7
		}
	</style>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
	<script>
		var defaultThemeMode = "light";
		var themeMode;
		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
			} else {
				if (localStorage.getItem("data-bs-theme") !== null) {
					themeMode = localStorage.getItem("data-bs-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-bs-theme", themeMode);
		}
	</script>

	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			@include('layouts.header')
			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				@include('layouts.sidebar')
				<div class="content-wrapper">
					@yield('container')
				</div>
				@include('layouts.footer')
			</div>
		</div>
	</div>

	<!-- JavaScript -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script> -->
	<!-- <script src="{!! asset('/plugins/custom/fullcalendar/fullcalendar.bundle.js') !!}"></script> -->
	<!-- <script src="{!! asset('/plugins/custom/datatables/datatables.bundle.js') !!}"></script> -->
	<script src="{!! asset('/plugins/global/plugins.bundle.js') !!}"></script>
	<script src="{!! asset('/js/scripts.bundle.js') !!}"></script>
	<script src="{!! asset('/js/widgets.bundle.js') !!}"></script>
	<script src="{!! asset('/js/loading.js') !!}"></script>
	<script src="{!! asset('/js/custom/widgets.js') !!}"></script>
	<script src="{!! asset('/js/custom/apps/chat/chat.js') !!}"></script>
	<script src="{!! asset('/js/checkbox.js') !!}"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
	<script src="{!! asset('/js/ckeditor.js') !!}"></script>
	<!-- Other scripts -->

</body>

</html>