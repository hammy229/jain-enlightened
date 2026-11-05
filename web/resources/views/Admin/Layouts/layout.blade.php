<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('meta_title')</title>
    
    @include('Admin.Includes.header')
</head>
    <body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true'>
        <input type="hidden" value="{{url('/')}}" id="base_url"/>      
        @include('Admin.Includes.navbar')
        <div class="d-flex">
            @include('Admin.Includes.sidebar')
            @yield('content')
        </div>
        @include('Admin.Includes.footer')
    </body>
</html>