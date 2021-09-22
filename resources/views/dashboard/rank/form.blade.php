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
                    <h5 class="title">{{ $action }} @lang('Rank')</h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="dashboardForm" action="{{ route('dashboard.ranks.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                        <div class="form-group">
                            <label for="category">@lang('Product')</label>
                            <select class="form-control" id="product" name="product">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" >{{ $product->name }} - {{ $product->game->game_name }}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">@lang('Rank Name')</label>
                                <input type="hidden" name="counter[]">
                                <input class="form-control" type="text" name="name[]" placeholder="Enter Rank Name" value="" >
                            </div>
                        </div>
                          <div class="col-md-6">
                          <div class="form-group">
                              <label for="name">@lang('Rank Level')</label>
                              <input class="form-control" type="text" name="level[]" value="" >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                {{-- @if($scheme != null)
                                    <label>Rank Image:</label>
                                    <img src="{{ asset('dash/images/boosting/product') . '/' . $scheme->product->id . '/endrange/' .  $scheme->end_range . $scheme->end_image }}" style="height:200px;">
                                    <br>
                                @endif --}}
                                <input name="image[]" type="file" value="">
                                <button class="btn btn-outline-primary" type="button">Upload Rank Image</button>
                            </div>

                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">@lang('Price')($)</label>
                            <input class="form-control" type="number" min="0" step="0.01" name="price[]" placeholder="1" >
                        </div>
                      </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                            <label for="name">@lang('Order')</label>
                              <input type="number" class="form-control" min="0" step="1" name="rank_order[]" placeholder="0" value="">
                          </div>
                      </div>
                      <div class="addition_div">

                      </div>
                      <div class="add_more_link"><a href="javascript:void(0)">Add More...</a></div>
                        <div class="form-group">
                            <button type="submit" class="submitButton btn btn-outline-success">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class='additional' style="display:none;">
  <div class="additional_rank square_border">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
            <label for="name">@lang('Rank Name')</label>
            <input type="hidden" name="counter[]">
            <input class="form-control" type="text" name="name[]" placeholder="Enter Rank Name" value="" >
        </div>
    </div>
      <div class="col-md-6">
      <div class="form-group">
          <label for="name">@lang('Rank Level')</label>
          <input class="form-control" type="text" name="level[]" value="" >
      </div>
    </div>
  </div>

  <div class="row">
      <div class="col-md-6">
        <div class="form-group">
            <input name="image[]" type="file" value="">
            <button class="btn btn-outline-primary" type="button">Upload Rank Image</button>
        </div>

  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label for="name">@lang('Price')($)</label>
        <input class="form-control" type="number" min="0" step="0.01" name="price[]" placeholder="1" value="" >
    </div>
  </div>
  </div>
  <div class="row">
      <div class="col-md-6">
        <label for="name">@lang('Order')</label>
          <input type="number" class="form-control" min="0" step="1" name="rank_order[]" placeholder="0" value="">
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
        $(".add_more_link a").on("click",function(){
          var additional_data = $(".additional").html();
          $(".addition_div").append(additional_data);
        });
    });
</script>
</html>
