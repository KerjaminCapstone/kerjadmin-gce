<!DOCTYPE html>
<html lang="en">

@include('includes.header')

<body>
    <div id="app">
        @include('includes.sidebar')
        <div id="main" class='layout-navbar'>
            @include('includes.greeting')
            <div id="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    @include('includes.footer-script')

    {{-- Addon Script --}}
    @stack('custom-scripts')
</body>

</html>
