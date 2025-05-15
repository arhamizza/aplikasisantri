<div class="sidebar" data-color="black" data-active-color="success">
    <div class="logo">
        <a href="{{ route('page.index', 'home') }}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a href="{{ route('page.index', 'home') }}" class="simple-text logo-normal">
            {{ __('aplikasi') }}
        </a>
    </div>
    <div class="sidebar-wrapper">

        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'dashboard_admin') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'kategoripaket' || $elementActive == 'paket' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#paket">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                        {{ __('Data Paket') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="paket">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'paket' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'paket_admin') }}">
                                <span class="sidebar-mini-icon">{{ __('P') }}</span>
                                <span class="sidebar-normal">{{ __(' paket ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'kategoripaket' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'kategoripaket_admin') }}">
                                <span class="sidebar-mini-icon">{{ __('KP') }}</span>
                                <span class="sidebar-normal">{{ __(' Kategori Paket ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'santri' || $elementActive == 'asrama' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#santri">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                        {{ __('Data Sekolah') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="santri">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'santri' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'santri_admin') }}">
                                <span class="sidebar-mini-icon">{{ __('S') }}</span>
                                <span class="sidebar-normal">{{ __(' Santri ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'asrama' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'asrama_admin') }}">
                                <span class="sidebar-mini-icon">{{ __('A') }}</span>
                                <span class="sidebar-normal">{{ __(' Asrama ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'laporanmasuk' || $elementActive == 'laporankeluar' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laporan">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                        {{ __('Laporan') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laporan">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'laporanmasuk' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'laporan_admin') }}">
                                <span class="sidebar-mini-icon">{{ __('M') }}</span>
                                <span class="sidebar-normal">{{ __(' Data Masuk ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'laporankeluar' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'laporan_admin2') }}">
                                <span class="sidebar-mini-icon">{{ __('K') }}</span>
                                <span class="sidebar-normal">{{ __(' Data Keluar ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'usermanagement') }}">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p>{{ __('user') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'setting' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'setting') }}">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p>{{ __('setting') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
