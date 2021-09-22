<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.header')

<body class="">
<div class="wrapper">
    @include('dashboard.layouts.sidebar')
      <div class="main-panel" id="main-panel">
        @include('dashboard.layouts.navbar')
        <div class="container" style="margin-top:10%;">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ $action }} Discount Code @if($discountcode != null) {{ $discountcode->code }} @endif</h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="dashboardForm" action="{{ ($discountcode) ? route('dashboard.discountcodes.edit', [$discountcode->id]) : route('dashboard.discountcodes.create') }}">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="code">Discount Code<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                <input class="form-control" type="text" name="code" required id="code" placeholder="Please enter a discount code" value="{{ ($discountcode != null) ? $discountcode->code : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="percentage_discount">Percentage Off Price (%)<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                <br>
                                <small class="text-info">E.G: If you set 10 here, it will take 10% off the final order price.</small>
                                <input class="form-control" type="number" max="100" min="0" step="1" required name="percentage_discount" id="percentage_discount" placeholder="Please enter a discount code" value="{{ ($discountcode != null) ? $discountcode->percentage_discount : '' }}" required>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <button type="submit" class="submitButton btn btn-outline-success">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@include('dashboard.layouts.scripts')
</html>