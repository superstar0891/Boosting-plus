@include('frontend.layouts.header')
<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
@include('frontend.layouts.nav')
<section class="page-top-section set-bg" data-setbg="{{ asset('frontend/img/page-top-bg/1.jpg') }}">
</section>
<section class="games-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="big-blog-item">
                    <div class="blog-content text-box text-left text-white">
                        <h3>@lang('Our Terms Of Service'):</h3>
                        <ol class="mb-4">
                            <li>@lang('EZ-Boosting.com sells only services in the form of digital goods, by no means we sell any physical products or ship any physical goods')</li>
                            <li>@lang('We do not claim to be the owners or representatives of the trademarks, brands and intellectual properties of others – they remain the property of their original copyright owners.')</li>
                            <li>@lang('All submitted art content remains copyright of its original copyright holder.')</li>
                            <li>@lang('EZ-Boosting.com reserves the right to change or alter any of the Site’s content, conditions, terms, or policies, as well as our respective extensions, at any time and without notice. By using any service that the Site offers, you agree that EZ-Boosting.com can’t be liable or accountable to you for any modification, suspension or discontinuance of the services.')</li>
                            <li>@lang('By purchasing in EZ-Boosting.com you agree that you are at least 18 years old. If you are under 18 years of age, you must have the permission of a parent or legal guardian')</li>
                            <li>@lang('By agreeing to EZ-Boosting.com terms of service you agree not to raise a dispute or any chargebacks through PayPal, if you do, you are bound to either closing the dispute/chargeback or paying 50% of your order’s value, however if the order is finished you can not refund')</li>
                            <li>@lang('Customers reserve the right to know the status of their orders')</li>
                            <li>@lang('Customers reserve the right to cancel their order at anytime for any reasons, if we haven’t started the order a refund of 75% of the total price will be given but in case we started the order, the percentage of the refund should be estimated by the admins')</li>
                            <li>@lang('Refunds can be requested but will only be granted under the website owners’ permission')</li>
                        </ol>
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
