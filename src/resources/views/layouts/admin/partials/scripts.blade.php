{{-- Start: Theme Customizer --}}
@include('layouts.admin.partials.theme-customization')
{{-- End: Theme Customizer --}}

{{-- Start: Load Main Scripts --}}
{{-- Start: Get asset for language locale in app.js class I18nManager --}}
<script>
    window.Laravel = {
        translationsPath: "{{ asset('assets/admin/data/translations/') . '/' }}",
        assetUrl: "{{ asset('') }}",
        csrfToken: "{{ csrf_token() }}",
        appLocale: "{{ app()->getLocale() }}"
    };
    </script>
{{-- End: Get asset for language locale in app.js class I18nManager --}}

<script src="{{ URL::asset('assets/admin/js/vendors.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/js/app.js') }}"></script>
{{-- End: Load Main Scripts --}}

{{-- Start: Custom JS --}}
<!-- Apex Chart js -->
{{-- <script src="{{ URL::asset('assets/admin/plugins/apexcharts/apexcharts.min.js') }}"></script> --}}

<!-- Vector Map Js -->
{{-- <script src="{{ URL::asset('assets/admin/plugins/jsvectormap/jsvectormap.min.js') }}"></script> --}}
{{-- <script src="{{ URL::asset('assets/admin/js/maps/world-merc.js') }}"></script> --}}
{{-- <script src="{{ URL::asset('assets/admin/js/maps/world.js') }}"></script> --}}

<!-- Custom table -->
{{-- <script src="{{ URL::asset('assets/admin/js/pages/custom-table.js') }}"></script> --}}
{{-- End: Custom JS --}}

<!-- Dashboard js -->
{{-- <script src="{{ URL::asset('assets/admin/js/pages/dashboard-ecommerce.js') }}"></script> --}}

{{-- Start: SweetAlert2 --}}
@include('layouts.admin.partials.alerts-script')
{{-- End: SweetAlert2 --}}
        
{{-- Start: Stack Scripts --}}
@stack('scripts')
{{-- End: Stack Scripts --}}