@include('frontend.layouts.header')
<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
@include('frontend.layouts.nav')
<section class="page-top-section set-bg" data-setbg="{{ asset('frontend/images/promo-bg.jpg') }}">
</section>
<section class="games-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="big-blog-item">
                    @if(LaravelLocalization::getCurrentLocale() == 'en')
                        <img src="{{ asset('frontend/img/page-top-bg/thankyou.jpg') }}" alt="#" class="blog-thumbnail">
                    @else
                        <img src="{{ asset('frontend/img/page-top-bg/thankyou2.jpg') }}" alt="#" class="blog-thumbnail">
                    @endif
                    <div class="blog-content text-box text-center text-white">
                        <h3>@lang('Your Order Has Been Received!')</h3>
                        <h6 class="mb-2">@lang('So, what is next?')</h6>
                        <ol class="mb-4">
                            <li>@lang('A booster will now accept your order at some point over the next 24 hours')</li>
                            <li>@lang('They will communicate with you the progress of the order via the dashboard')</li>
                            <li>@lang('They will let you know when the order has been completed')</li>
                        </ol>
                        <ul class="blog-filter">
                            <li><a href="{{ route('login') }}">@lang('Login To Your Dashboard')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Games end-->
<!-- Footer section -->
@include('frontend.layouts.footer')
</body>
</html>
