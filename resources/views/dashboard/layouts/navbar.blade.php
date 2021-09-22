<nav class="navbar navbar-expand-sm navbar-dark bg-danger d-md-inline d-lg-none">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ asset('frontend/images/logo1.png') }}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav">
                {{-- <li class="nav-item @if (\Request::is('dashboard')) active @endif ">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="now-ui-icons objects_globe"></i>
                        <p>@lang('Dashboard')</p>
                    </a>
                </li> --}}
                @if(Auth::user()->type == "Administrator")
                    <li class="nav-item @if (\Request::is('dashboard.games')) active @endif ">
                        <a class="nav-link" href="{{ route('dashboard.games') }}">
                            <i class="fas fa-gamepad"></i>
                            <p>@lang('Games')</p>
                        </a>
                    </li>
                    <li class="nav-item @if (\Request::is('dashboard.products')) active @endif ">
                        <a class="nav-link" href="{{ route('dashboard.products') }}">
                            <i class="now-ui-icons shopping_box"></i>
                            <p>@lang('Services')</p>
                        </a>
                    </li>
                    <li class="nav-item @if (\Request::is('dashboard.productaddons')) active @endif ">
                        <a class="nav-link" href="{{ route('dashboard.productaddons') }}">
                            <i class="now-ui-icons shopping_tag-content"></i>
                            <p>@lang('Service Addons')</p>
                        </a>
                    </li>
                    <li class="nav-item @if (\Request::is('dashboard.boostpricescheme')) active @endif ">
                        <a class="nav-link" href="{{ route('dashboard.boostpricescheme') }}">
                            <i class="now-ui-icons shopping_tag-content"></i>
                            <p>@lang('Boost Pricing')</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item @if (\Request::is('dashboard.orders')) active @endif ">
                    <a class="nav-link" href="{{ route('dashboard.orders') }}">
                        <i class="now-ui-icons shopping_credit-card"></i>
                        <p>@lang('Orders')</p>
                    </a>
                </li>
                @if(Auth::user()->type == "Administrator")
                    <li class="nav-item @if (\Request::is('dashboard.customers')) active @endif ">
                        <a class="nav-link" href="{{ route('dashboard.customers') }}">
                            <i class="fas fa-user-tie"></i>
                            <p>Customers</p>
                        </a>
                    </li>

                    <li class="nav-item @if (\Request::is('dashboard.boosters')) active @endif ">
                        <a class="nav-link" href="{{ route('dashboard.boosters') }}">
                            <i class="fas fa-user-secret"></i>
                            <p>Boosters</p>
                        </a>
                    </li>
                    <li class="nav-item @if (\Request::is('dashboard.discountcodes')) active @endif ">
                        <a class="nav-link" href="{{ route('dashboard.discountcodes') }}">
                            <i class="fas fa-tags"></i>
                            <p>Discount Codes</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item @if (\Request::is('dashboard.chat')) active @endif ">
                    <a class="nav-link" href="{{ route('dashboard.chat') }}">
                        <i class="fas fa-comments"></i>
                        <p>@lang('Chat')</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
