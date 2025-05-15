@include('layouts.navbars.navs.guest')

<div class="wrapper wrapper-full-page ">
    <div class="full-page section-image" filter-color="blue" data-image="{{ asset('paper') }}/img/bg/.jpg">
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
