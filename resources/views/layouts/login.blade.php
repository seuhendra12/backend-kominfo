<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title','Dashboard')</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
	<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
	<link rel="shortcut icon" href="{!! asset('/media/images/logo_kominfo.png') !!}" />
	<!--begin::Fonts(mandatory for all pages)-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Vendor Stylesheets(used for this page only)-->
	<link href="{!! asset('/plugins/custom/fullcalendar/fullcalendar.bundle.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('/plugins/custom/datatables/datatables.bundle.css') !!}" rel="stylesheet" type="text/css" />
	<!--end::Vendor Stylesheets-->
	<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
	<link href="{!! asset('/plugins/global/plugins.bundle.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('/css/style.bundle.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('/css/loading.css') !!}" rel="stylesheet" type="text/css" />

</head>

<body>
	@yield('container')
	<script>
		var hostUrl = "assets/";
	</script>
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="{!! asset('/plugins/global/plugins.bundle.js') !!}"></script>
	<script src="{!! asset('/js/scripts.bundle.js') !!}"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Vendors Javascript(used for this page only)-->
	<script src="{!! asset('/plugins/custom/fullcalendar/fullcalendar.bundle.js') !!}"></script>
	<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
	<script src="{!! asset('/plugins/custom/datatables/datatables.bundle.js') !!}"></script>
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used for this page only)-->
	<script src="{!! asset('/js/widgets.bundle.js') !!}"></script>
	<script src="{!! asset('/js/loading.js') !!}"></script>
	<script src="{!! asset('/js/custom/widgets.js') !!}"></script>
	<script src="{!! asset('/js/custom/apps/chat/chat.js') !!}"></script>
	<script src="{!! asset('/js/custom/utilities/modals/upgrade-plan.js') !!}"></script>
	<script src="{!! asset('/js/custom/utilities/modals/create-app.js') !!}"></script>
	<script src="{!! asset('/js/custom/utilities/modals/new-target.js') !!}"></script>
	<script src="{!! asset('/js/custom/utilities/modals/users-search.js') !!}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- <script src="{{ asset('js/app.js') }}"></script> -->
</body>
<script type="text/javascript">
	$('#reload').click(function() {
		$.ajax({
			type: 'GET',
			url: 'reload-captcha',
			success: function(data) {
				$(".captcha span").html(data.captcha);
			}
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.form-checkbox').click(function() {
			if ($(this).is(':checked')) {
				$('.form-password').attr('type', 'text');
			} else {
				$('.form-password').attr('type', 'password');
			}
		});
	});
</script>

</html>