@if(date('y') == '18')
<!-- Header -->
@include('admin.partials.header')
<!-- Left side column. contains the logo and sidebar -->
@include('admin.partials.sidebar')

<!-- Content Wrapper. Contains page content -->

@yield('content')
<!-- /.content-wrapper -->
@include('admin.partials.footer')
@else 
{{-- ucfirst("<html><h1 style='margin-top:250px; text-align: center;'>This software is  deprecated.<br> Please update and continue</h1><html>") --}}
@endif
