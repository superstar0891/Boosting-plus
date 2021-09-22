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
                    <h5 class="title">{{ $action }} Product @if($product != null)- {{ $product->name }} @endif</h5>
                </div>
                <div class="card-body">
                    <h5>Product Details</h5>
                    <form method="POST" id="dashboardForm" action="{{ ($product) ? route('dashboard.products.edit', [$product->id]) : route('dashboard.products.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            @if($product != null)
                                <label>Current File:</label>
                                <img src="{{ asset('dash/images/products') . '/' . $product->image }}" style="height:200px;">
                                <br>
                            @endif
                            <input id="image" name="image" type="file" value="{{ ($product != null) ? $product->image : '' }}" @if($product == null) required @endif>
                            <button class="btn btn-outline-primary" type="button">Upload Image</button>
                        </div>
                        <div class="form-group">
                            <label for="category">Game</label><span class="text-danger"><small> - @lang('Required')</small></span>
                            <select class="form-control" id="game" name="game">
                                @foreach($games as $game)
                                    <option value="{{ $game->id }}" @if($product != null && $product->game_id == $game->id) selected @endif >{{ $game->game_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Product Link</label><span class="text-danger"><small> - @lang('Required')</small></span>
                            <input class="form-control" type="text" name="product_link" id="product_link" placeholder="Please Enter A Product Link" value="{{ ($product != null) ? $product->product_link : '' }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <h6>English Translation</h6>
                                <div class="form-group">
                                    <label for="name">Product Name<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <input class="form-control" type="text" name="nameEN" id="name" placeholder="Please Enter A Product Name" value="{{ ($product != null) ? $product->getTranslation('name','en') : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Product Short Description<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <input class="form-control" type="text" name="short_descriptionEN" id="short_description" placeholder="Please Enter A Short Product Description"
                                           value="{{ ($product != null) ? $product->getTranslation('short_description','en') : '' }}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Product Description<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <textarea name="descriptionEN" id="summernoteEN" class="summernoteEN" required>{{ ($product != null) ? $product->getTranslation('description','en') : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Arabic Translation</h6>
                                <div class="form-group">
                                    <label for="name">Product Name<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <input class="form-control" type="text" name="nameAR" id="name" placeholder="Please Enter A Product Name" value="{{ ($product != null) ? $product->getTranslation('name','ar') : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Product Short Description<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <input class="form-control" type="text" name="short_descriptionAR" id="short_description" placeholder="Please Enter A Short Product Description"
                                           value="{{ ($product != null) ? $product->getTranslation('short_description','ar') : '' }}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Product Description<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <textarea name="descriptionAR" id="summernoteAR" class="summernoteAR" required>{{ ($product != null) ? $product->getTranslation('description','ar') : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Product Price($)<span class="text-danger"><small> - @lang('Required')</small></span></label>
                            <input class="form-control priceField" type="number" min="0" name="price" id="price" placeholder="Please Enter A Product Price" value="{{ ($product != null) ? $product->price : '' }}" required>
                        </div>
                        <hr>
                        <h6>Configure Your Product</h6>
                        <div class="form-check form-group">
                            <label for="price">Should This Product Have Duo-Q?</label>
                            <br>
                            <label class="form-check-label">
                                <input class="form-check-input duoQCheck" type="checkbox" name="duoq_check" value="yes" @if($product != null && $product->hasDuoQ()) checked @endif>
                               Duo-Q Check
                                <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                            </label>
                        </div>
                        <div class="d-none" id="duoqprice">
                            <h6>Duo-Q Settings</h6>
                            <div class="form-group">
                                <label for="duoq_price">Duo Q Price(%)<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                <input class="form-control duoqPrice" type="number" min="0" name="duoq_price" id="price" placeholder="Please Enter A Duo-Q Price" value="@if($existingDuoQ != null){{ $existingDuoQ->price_in_percent }}@endif">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>English Translation</h6>
                                    <div class="form-group">
                                        <label for="name">DuoQ Description<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                        <input class="form-control" type="text" name="duoq_descriptionEN" id="duoq_description" placeholder="Please Enter A Description"
                                               value="@if($existingDuoQ != null){{ $existingDuoQ->getTranslation('description', 'en') }}@endif">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6>Arabic Translation</h6>
                                    <div class="form-group">
                                        <label for="name">DuoQ Description<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                        <input class="form-control" type="text" name="duoq_descriptionAR" id="duoq_description" placeholder="Please Enter A Description"
                                               value="@if($existingDuoQ != null){{ $existingDuoQ->getTranslation('description', 'ar') }}@endif">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-group">
                            <label for="placement_match">Placement Match Check</label>
                            <br>
                            <label class="form-check-label">
                                <input class="form-check-input placementCheck" type="checkbox" name="placement_match" value="yes" @if($product != null && $product->type == "Placement") checked @endif>
                                Is this product a placement match product?
                                <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                            </label>
                        </div>
                        <div class="form-group placementPriceDiv d-none">
                          <div class="form-group">
                              <label for="placement_matches_text">Amount Of Matches Text<span class="text-danger"><small> - @lang('Required')</small></span></label>
                              <input class="form-control" type="text" name="matches_text" id="matches_text" placeholder="Please Enter Text For Amount Of Matches Text" value="@if($product != null){{ $product->matches_text }}@endif">
                          </div>
                            <div class="form-group">
                                <label for="placement_matches">Maximum Amount Of Placement Matches<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                <input class="form-control placementInputPrice" type="number" min="0" name="placement_matches" id="placement_matches" placeholder="Please Enter A Maximum Amount Of Matches" value="@if($product != null){{ $product->placement_maximum_amount_of_matches }}@endif">
                            </div>
                        </div>
                        <div class="form-check form-group">
                            <label for="price">Boosting Service Check</label>
                            <br>
                            <label class="form-check-label">
                                <input class="form-check-input boostCheck" type="checkbox" name="boosting_service" value="yes" @if($product != null && $product->type == "Boosting") checked @endif>
                                Is this product a boosting service?
                                <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                            </label>
                        </div>
                        <div class="row d-none" id="boostingNames">
                            <div class="col-md-12">
                                <h6>Boosting Settings</h6>
                                <small class="text-info">This relates to the boosting product. For example, this could be 'levels', 'points' or 'ranks'.</small>
                            </div>
                            <div class="col-md-6">
                                <h6>English Translation</h6>
                                <div class="form-group">
                                    <label for="name">Boosting Name<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <input class="form-control boostName" type="text" name="boostingNameEN" id="boostingNameEN" placeholder="Please Enter A Boosting Name"
                                           value="{{ ($product != null) ? $product->getTranslation('prefered_boost_name','en') : '' }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Arabic Translation</h6>
                                <div class="form-group">
                                    <label for="name">Boosting Name<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <input class="form-control boostName" type="text" name="boostingNameAR" id="boostingNameAR" placeholder="Please Enter A Boosting Name"
                                           value="{{ ($product != null) ? $product->getTranslation('prefered_boost_name','ar') : '' }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-group">
                            <label for="price">Is this product Rank System?</label>
                            <br>
                            <label class="form-check-label">
                                <input class="form-check-input rank_system" type="checkbox" name="rank_system" value="yes" @if($product != null && $product->type=="Rank") checked @endif>
                               Rank system
                                <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                            </label>
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
        $('.placementCheck').on('click', function() {
            if($(this).prop('checked')) {
                if ($('.boostCheck').prop('checked')) {
                    $('.boostCheck').click();
                }
                $('.boostCheck').prop('checked', false);
                $('.boostCheck').attr('disabled', true);
                $('.priceField').attr('disabled', true).val(0);
                $('.placementPriceDiv').removeClass('d-none');
                $('.placementInputPrice').prop('required', true);
                $('.rank_system').prop('checked', false);
                $('.rank_system').attr('disabled', true);
            } else {
                $('.placementInputPrice').prop('required', false);
                $('.placementPriceDiv').addClass('d-none');
                $('.priceField').attr('disabled', false);
                $('.boostCheck').attr('disabled', false);
                $('.placementInputPrice').val('');
                $('.rank_system').attr('disabled', false);
            }
        });
        $('.duoQCheck').on('click', function() {
            if($(this).prop('checked')) {
                $('#duoqprice').removeClass('d-none');
                $('.duoqprice').attr('required', true);
                $('#duoq_description').attr('required', true);
            } else {
                $('#duoqprice').addClass('d-none');
                $('.duoqPrice').val('');
                $('.duoqprice').attr('required', false);
                $('#duoq_description').val('');
                $('#duoq_description').attr('required', false);
            }
        });
        @if($product != null && $product->type == "Placement")
        $('.placementPriceDiv').removeClass('d-none');
        $('.placementInputPrice').attr('required', true);
        $('.boostCheck').attr('disabled', true);
        $('.priceField').attr('disabled', true).val(0);
        @endif

        @if($product != null && $product->type == "Rank")
        $('.boostCheck').attr('disabled', true);
        $('.priceField').attr('disabled', true).val(0);
        $('.placementCheck').attr('disabled', true);
        @endif

        @if($product != null && $product->hasDuoQ())
        $('#duoqprice').removeClass('d-none');
        @endif

        @if($product != null && $product->type == "Boosting")
        $('#boostingNames').removeClass('d-none');
        $('.boostName').attr('disabled', false);
        $('.priceField').attr('disabled', true).val(0);
        $('.placementCheck').prop('checked', false);
        $('.placementCheck').attr('disabled', true);
        @endif

        $('.boostCheck').on('click', function () {
            if ($(this).prop('checked')) {
                $('.placementCheck').prop('checked', false);
                $('.placementCheck').attr('disabled', true);
                $('.priceField').attr('disabled', true).val(0);
                $('.boostName').attr('disabled', false);
                $('#boostingNames').removeClass('d-none');
                $('.rank_system').prop('checked', false);
                $('.rank_system').attr('disabled', true);
            } else {
                $('.placementCheck').attr('disabled', false);
                $('.priceField').attr('disabled', false);
                $('.boostName').attr('disabled', true).val();
                $('#boostingNames').addClass('d-none');
                $('.boostName').val('');
                $('.rank_system').attr('disabled', false);
            }
        });

         $('.rank_system').on('click', function () {
            if ($(this).prop('checked')) {
                $('.placementCheck').prop('checked', false);
                $('.placementCheck').attr('disabled', true);
                $('.priceField').attr('disabled', true).val(0);
                $('.boostCheck').prop('checked', false);
                $('.boostCheck').attr('disabled', true);
            }else{        
                $('.placementCheck').attr('disabled', false);
                $('.priceField').attr('disabled', false);                
                $('.boostCheck').attr('disabled', false);
            }
         });
        //assign the variable passed from controller to a JavaScript variable.
                @if($product != null)
        var contentEN = {!! json_encode($product->getTranslation('description','en')) !!};
        //set the content to summernote using `code` attribute.
        $('.summernoteEN').summernote('code', contentEN);
        var contentAR = {!! json_encode($product->getTranslation('description','ar')) !!};
        //set the content to summernote using `code` attribute.
        $('.summernoteAR').summernote('code', contentAR);
        @endif
    });
</script>
</html>
