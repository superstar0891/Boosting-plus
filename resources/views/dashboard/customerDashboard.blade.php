<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.header')

<body class="">
<div class="wrapper ">
    @include('dashboard.layouts.sidebar')
      <div class="main-panel" id="main-panel">
        @include('dashboard.layouts.navbar')
        <div class="content">
            <div class="row mt-5">
                <div class="col-md-4 offset-md-4">
                    <h3>@lang('Welcome To Your Customer Dashboard!')</h3>
                </div>
            </div>
            <div class="row" style="margin-top:5%;">

                <div class="col-xl-6 col-md-6 mb-6">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">@lang('Your') @lang('Chat History')</div>
                                    <a class="btn btn-block btn-lg btn-primary" href="{{ route('dashboard.chat') }}">@lang('View')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 mb-6">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">@lang('Your Orders')</div>
                                    <a class="btn btn-block btn-lg btn-primary" href="{{ route('dashboard.orders') }}">@lang('View')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@include('dashboard.layouts.scripts')
</body>
</html>
