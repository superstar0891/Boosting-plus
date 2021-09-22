<div class="sidebar">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="sidebar-wrapper bg" id="sidebar-wrapper">
        <div class="logo">

            {{-- <a href="{{ route('dashboard') }}"><img  src="{{ asset('frontend/images/') }}/logo1.png" width=90%></a><br><br> --}}

            <div class='languagesetting'>@lang('WELCOME&ensp;&ensp;ADMIN')</div>
            {{-- <div style="text-align: center">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                @if($localeCode == "en")
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        <img src="{{ asset('frontend/img/english.svg') }}" height="40px">
                    </a>
                @endif
                @if($localeCode == "ar")
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        <img src="{{ asset('frontend/img/arabic.svg') }}" height="30px">
                    </a>
                @endif
            @endforeach
            </div> --}}
        </div>
        <ul class="nav">
            {{-- <li @if (\Request::is('dashboard')) @endif>
                <a href="{{ route('dashboard') }}">
                    <i class="now-ui-icons objects_globe"></i>
                    <p>@lang('Dashboard')</p>
                </a>
            </li> --}}
            @if(Auth::user()->type == "Administrator")
                <li @if (\Request::is('dashboard.games')) class="active" @endif>
                    <a href="{{ route('dashboard.games') }}">
                        <i class="fas fa-gamepad"></i>
                        <p>@lang('Games')</p>
                    </a>
                </li>
                <li @if (\Request::is('dashboard.products')) class="active" @endif>
                    <a href="{{ route('dashboard.products') }}">
                        <i class="now-ui-icons shopping_box"></i>
                        <p>@lang('Serivces')</p>
                    </a>
                </li>
                <li @if (\Request::is('dashboard.productaddons')) class="active" @endif>
                    <a href="{{ route('dashboard.productaddons') }}">
                        <i class="now-ui-icons shopping_tag-content"></i>
                        <p>@lang('Service  Addons')</p>
                    </a>
                </li>
                <li @if (\Request::is('dashboard.boostpricescheme')) class="active" @endif>
                    <a href="{{ route('dashboard.boostpricescheme') }}">
                        <i class="now-ui-icons shopping_tag-content"></i>
                        <p>@lang('Boost Pricing')</p>
                    </a>
                </li>
                <li @if (\Request::is('dashboard.ranks')) class="active" @endif>
                    <a href="{{ route('dashboard.ranks') }}">
                        <i class="now-ui-icons sport_trophy"></i>
                        <p>@lang('Rank')</p>
                    </a>
                </li>
                <li @if (\Request::is('dashboard.placement')) class="active" @endif>
                    <a href="{{ route('dashboard.placement') }}">
                        <i class="now-ui-icons sport_trophy"></i>
                        <p>@lang('Placement')</p>
                    </a>
                </li>
            @endif
            <li @if (\Request::is('dashboard.orders')) class="active" @endif>
                <a href="{{ route('dashboard.orders') }}">
                    <i class="now-ui-icons shopping_credit-card"></i>
                    <p>@lang('Orders')</p>
                </a>
            </li>
            @if(Auth::user()->type == "Administrator")
                <li @if (\Request::is('dashboard.customers')) class="active" @endif>
                    <a href="{{ route('dashboard.customers') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>@lang('Customers')</p>
                    </a>
                </li>

                <li @if (\Request::is('dashboard.boosters')) class="active" @endif>
                    <a href="{{ route('dashboard.boosters') }}">
                        <i class="fas fa-user-secret"></i>
                        <p>@lang('Boosters')</p>
                    </a>
                </li>
                <li @if (\Request::is('dashboard.discountcodes')) class="active" @endif>
                    <a href="{{ route('dashboard.discountcodes') }}">
                        <i class="fas fa-tags"></i>
                        <p>@lang('Discount Codes')</p>
                    </a>
                </li>
            @endif
            <li @if (\Request::is('dashboard.chat')) class="active" @endif>
                <a href="{{ route('dashboard.chat') }}">
                    <i class="fas fa-comments"></i>
                    <p>@lang('Chat')</p>
                </a>
            </li>
        </ul>
        <br>
            {{-- <small class="text-light">@lang('Welcome Back,') {{ Auth::user()->name }}</small> --}}
           <a class="btn-sm btn btn-danger-outline" href="{{ route('logout') }}">@lang('Logout')</a>
    </div>
</div>
