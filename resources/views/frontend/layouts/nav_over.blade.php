<!-- Navbar section -->
<div class="navigation-section">
  <div class="container-fluid">
    <div class="nav-inner">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top " style='background: #2a042e'>
        <a class="navbar-brand" href="/"><img src="{{ asset('frontend/images/logo1.png') }}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="/">@lang('Home')</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('SERVICE')
              </a>
              <div class="dropdown-menu" style='background: #2a042e' aria-labelledby="navbarDropdown">
                @foreach ($products as $product)
                <a class="dropdown-item" href="{{ url('games/'.$game->game_link.'/'.$product->product_link) }}">{{ $product->name }}</a>
                @endforeach
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/loyalty">WHY US?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="https://www.trustpilot.com/review/boostingplus.com">REVIEWS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="/contact-promotor">BLOGS</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('SUPPORT')
              </a>
              <div class="dropdown-menu" style='background: #2a042e' aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('games/overwatch') }}">overwatch</a>
                <a class="dropdown-item" href="{{ url('games/Apex Legends') }}">Apex Legends</a>
                <a class="dropdown-item" href="{{ url('games/League of legends') }}">League of legends</a>
                <a class="dropdown-item" href="{{ url('games/Call of duty CW') }}">Call of Duty CW</a>
                <a class="dropdown-item" href="{{ url('games/Call of duty MW') }}">Call of Duty MW</a>
                <a class="dropdown-item" href="{{ url('games/Valorant') }}">Valorant</a>
              </div>
            </li>
            <li class="nav-item">
              @if(Auth::user() == null)
                  <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-lg fa-user"></i>&ensp;@lang('Login')</a>
              @else
                  <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-lg fa-user"></i>&ensp;@lang('Members Area')</a>
              @endif
           </li>
          </ul>
        </div>
      </nav>
    </div><!--nav-inner-->
  </div><!--container-->
</div><!--navigation-section-->
<!-- Header section end -->

