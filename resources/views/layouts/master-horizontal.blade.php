<!DOCTYPE html>
<html lang="en">

@include('includes.header-horizontal')

<body>
    <div id="app">
        @yield('content')
    </div>

    @include('includes.footer-horizontal')

    {{-- Addon Script --}}
    @stack('custom-scripts')
</body>

</html>
