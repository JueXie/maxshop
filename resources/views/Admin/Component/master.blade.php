<!DOCTYPE HTML>
<html>
@include('Admin.Component.header')
<body>
@include('Admin.Component.topbar')

@include('Admin.Component.menu')

@yield('content')

@include('Admin.Component.footer')
@yield('js')
</body>
</html>
