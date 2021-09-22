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
                    <h5 class="title">{{ $action }} @lang('Boost Pricing Scheme') @if($scheme != null)- {{ $scheme->name }} @endif</h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="dashboardForm" action="{{ ($scheme) ? route('dashboard.boostpricescheme.edit', [$scheme->id]) : route('dashboard.boostpricescheme.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">@lang('Start Range')<span class="text-danger"><small> - @lang('Required')</small></span></label>
                            <input class="form-control rangeCheck" type="number" min="0" name="start_range" id="start_range" placeholder="0" value="{{ ($scheme != null) ? $scheme->start_range : '' }}" required>
                        </div>
                        <div class="form-group">
                            @if($scheme != null)
                                <label>Current File:</label>
                                <img src="{{ asset('dash/images/boosting/product') . '/' . $scheme->product->id . '/startrange/' .  $scheme->start_range . $scheme->start_image }}" style="height:200px;">
                                <br>
                            @endif
                            <input id="start_image" name="start_image" type="file" value="{{ ($scheme != null) ? $scheme->start_image : '' }}" @if($scheme == null) required @endif>
                            <button class="btn btn-outline-primary" type="button">Upload Start Range Image</button>
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('End Range')<span class="text-danger"><small> - @lang('Required')</small></span></label>
                            <input class="form-control rangeCheck" type="number" min="0" name="end_range" id="end_range" placeholder="1000" value="{{ ($scheme != null) ? $scheme->end_range : '' }}" required>
                        </div>
                        <div class="form-group">
                            @if($scheme != null)
                                <label>Current File:</label>
                                <img src="{{ asset('dash/images/boosting/product') . '/' . $scheme->product->id . '/endrange/' .  $scheme->end_range . $scheme->end_image }}" style="height:200px;">
                                <br>
                            @endif
                            <input id="end_image" name="end_image" type="file" value="{{ ($scheme != null) ? $scheme->end_image : '' }}" @if($scheme == null) required @endif>
                            <button class="btn btn-outline-primary" type="button">Upload End Range Image</button>
                        </div>
                        <div class="form-group">
                            <label for="category">@lang('Product')</label><span class="text-danger"><small> - @lang('Required')</small></span>
                            <select class="form-control" id="product" name="product">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" @if($scheme != null && $scheme->product_id == $product->id) selected @endif >{{ $product->name }} - {{ $product->game->game_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('Price Per Level')($)<span class="text-danger"><small> - @lang('Required')</small></span></label>
                            <input class="form-control" type="number" min="0" step="0.001" name="price_per_level" id="price_per_level" placeholder="1" value="{{ ($scheme != null) ? $scheme->price_per_level : '' }}" required>
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
<script>
    $(function () {
        $('.rankCheck').on('click', function() {
            if ($(this).prop('checked')) {
                $('.rangeCheck').attr('disabled', true).val();
                $('.rankInputCheck').attr('disabled', false);
            } else {
                $('.rangeCheck').attr('disabled', false);
                $('.rankInputCheck').attr('disabled', true).val();
            }
        });
    });
</script>
</html>
