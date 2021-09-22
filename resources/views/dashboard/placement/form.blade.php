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
                    <h5 class="title">{{ $action }} Placement  @if($placement != null)- {{ $placement->name }} @endif</h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="dashboardForm" action="{{ ($placement) ? route('dashboard.placement.edit', [$placement->id]) : route('dashboard.placement.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Placement Name (English)<span class="text-danger"><small style="display:none;"> - @lang('Required')</small></span></label>
                                    <input class="form-control" type="text" name="nameEN" id="name" placeholder="Please Enter A Placement Name" value="{{ ($placement != null) ? $placement->getTranslation('name','en') : '' }}" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Placement Name (Arabic)<span class="text-danger"><small style="display:none;"> - @lang('Required')</small></span></label>
                                    <input class="form-control" type="text" name="nameAR" id="name" placeholder="Please Enter A Placement Name" value="{{ ($placement != null) ? $placement->getTranslation('name','ar') : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('Price Per Match')<span class="text-danger"><small> - @lang('Required')</small></span></label>
                            <input class="form-control" type="text" min="0" name="price_per_match" id="price_per_match" placeholder="0" value="{{ ($placement != null) ? $placement->price_per_match : '' }}" required>
                        </div>
                        <div class="form-group">
                            @if($placement != null)
                                <label>Current File:</label>
                                <img src="{{ asset('dash/images/placement/product') . '/' . $placement->product->id . '/' .  $placement->id . $placement->image }}" style="height:200px;">
                                <br>
                            @endif
                            <input id="image" name="image" type="file" value="{{ ($placement != null) ? $placement->image : '' }}" @if($placement == null) @endif>
                            <button class="btn btn-outline-primary" type="button">Upload Image</button>
                        </div>
                        <div class="form-group">
                            <label for="category">@lang('Product')</label><span class="text-danger"><small> - @lang('Required')</small></span>
                            <select class="form-control" id="product" name="product">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" @if($placement != null && $placement->product_id == $product->id) selected @endif >{{ $product->name }} - {{ $product->game->game_name }}</option>
                                @endforeach
                            </select>
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
