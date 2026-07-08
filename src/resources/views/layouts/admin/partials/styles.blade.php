{{-- Styles --}}
<link rel="stylesheet" href="{{ URL::asset('assets/admin/css/app.min.css') }}">

{{-- Sweet Alert Styles --}}
<link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/sweetalert2/sweetalert2.min.css') }}">

{{-- Favicon --}}
<link rel="shortcut icon" type="image/png" href="{{ URL::asset($prefs_composer['favicon']) }}">

@stack('styles')