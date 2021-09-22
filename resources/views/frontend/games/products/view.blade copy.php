@include('frontend.layouts.header')
<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
{{-- @include('frontend.layouts.nav_over') --}}
<section class="page-top-section set-bg text-center" data-setbg="@if($game->image_banner) {{ asset('dash/images/games') . '/' . $game->image_banner }} @else {{ asset('frontend/images/promo-bg.jpg') }} @endif">
    <div class="page-info">
        <h2>{{ $game->game_name }} - {{ $product->name }}</h2>
        <div class="site-breadcrumb" style="display:none;">
            <a href="">@lang('Home')</a> /
            <a href="{{ route('games') }}">@lang('Games')</a> /
            <a href="{{ route('games.view', $product->game->id) }}">{{ $product->game->game_name }}</a> /
            <span>{{ $product->name }}</span>
        </div>
    </div>
</section>
<!-- Games section -->
<section class="games-single-page">
    <div class="container">
        <div class="row game-single-content">
          <div class="col-xl-12 col-lg-12 col-md-12"><h2 class="gs-title text-center">{{ $product->name }}</h2></div>
          <div class="col-xl-12 col-lg-12 col-md-12"><hr></div>
            <div class="col-xl-4 col-lg-4 col-md-4"><img src="{{ asset('dash/images/products') }}/{{ $product->image }}" alt=""></div>
            <div class="col-xl-8 col-lg-8 col-md-8">
              <!-- <h4>@lang('Product Description')</h4> -->
            {!! $product->description !!}
          </div>
            <div class="col-xl-12 col-lg-12 col-md-12">
                <form method="POST" action="{{ route('checkout', $product->id) }}">
                    {{ csrf_field() }}
                    <h4>@lang('Order Form')</h4>


                    <div class="row">
                        <div class="col-md-6">
                          <!--Rank System--><div class="row">
                          @if(count($ranks_name)>0)
                          <div class='col-md-3 vert_cent'><label class="text-light">Current Rank</label></div>
                          <div class="col-md-9">
                            <div class="current_rank_image rank_image">
                              @if($ranks_name[0]['image'] != "" || $ranks_name[0]['image'] != null)
                                <img src="{{ asset('dash/images/rank/'). '/' . $product->id . '/' .  $ranks_name[0]['image']}}">
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="row mt-4">
                              <div class="col-md-6">
                                <input type="hidden" name="real_rank_amount" class="real_rank_amount" value="">
                                <select name='current_rank_name' class='current_rank_name level_change form-control' data-target="current_rank_level" id="current_rank_name" data-image="current_rank_image">
                                  @foreach($ranks_name as $name)
                                    <option value='{{$name->id}}'>{{$name->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                          @endif
                          @if(count($ranks_level)>0)
                          <div class="col-md-6">
                            <select name='current_rank_level' class='current_rank_level get_price form-control' id="current_rank_level">
                              @foreach($ranks_level as $level)
                                <option value='{{$level->id}}'>{{$level->level}}</option>
                              @endforeach
                            </select>
                          </div>
                          @endif
                        </div>
                        <div class="row mt-4">
                          @if(count($ranks_name)>0)
                          <div class='col-md-3 vert_cent'><label class="text-light">Desired Rank</label></div>
                          <div class="col-md-9">
                            <div class="desired_rank_image rank_image">
                              @if($ranks_name[0]['image'] != "" || $ranks_name[0]['image'] != null)
                                <img src="{{ asset('dash/images/rank/'). '/' . $product->id . '/' .  $ranks_name[0]['image']}}">
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="row mt-4">
                              <div class="col-md-6">
                                <select name='desired_rank_name' class='desired_rank_name form-control level_change' data-target="desired_rank_level" data-image="desired_rank_image" id="desired_rank_name">
                                  @foreach($ranks_name as $name)
                                    <option value='{{$name->id}}'>{{$name->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                          @endif
                          @if(count($ranks_level)>0)
                          <div class="col-md-6">
                            <select name='desired_rank_level' class='desired_rank_level form-control get_price' id="desired_rank_level">
                              @foreach($ranks_level as $level)
                                <option value='{{$level->id}}'>{{$level->level}}</option>
                              @endforeach
                            </select>
                          </div>
                          @endif
                          </div><!--Rank System-->
                            @if($product->type == 'Placement')
                                <div class="row placementRow mb-5">
                                    <div class="col-md-6">
                                        <div class="placement-image-container text-center">
                                        </div>
                                        {{--@php $placement_cntr = 0; @endphp
                                        @foreach($placements as $placement)
                                          @if($placement->name!="")
                                            @php $placement_cntr++; @endphp
                                          @endif
                                        @endforeach --}}

                                        <select class="custom-select mt-3 placementSelect" name="placementSelect">
                                            @foreach($placements as $placement)
                                                <option value="{{ $placement->id }}" data-price="{{ $placement->price_per_match }}" data-extension="{{ $placement->image }}">{{ $placement->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="text-white" style="margin-top:100px">{{$product->matches_text!=null?$product->matches_text:"Amount Of Matches"}}:{{--@lang('Amount Of Matches:')--}} <span class="text-success matchesAmount"></span></h4>
                                        <input
                                                type="range"
                                                min="1"
                                                max="{{ $matchAmount }}"
                                                step="1"
                                                value="1"
                                                data-orientation="horizontal"
                                                name="match-amount"
                                                id="match-amount">
                                    </div>
                                </div>

                            @elseif($product->type == 'Boosting')
                                <div class="row boostingRow">
                                    <div class="col-md-6">
                                        <img class="start-image-holder">
                                        <label class="text-light" for="boostRangeCurrent">Current {{ $product->prefered_boost_name ?? '' }}</label>
                                        <div class="input-group">
                                            <input class="form-control" name="boostRangeCurrent" id="boostRangeCurrent" type="number" max="{{ $highestAmount }}" placeholder="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img class="end-image-holder">
                                        <label class="text-light" for="boostRangeDesired">Desired {{ $product->prefered_boost_name ?? '' }}</label>
                                        <div class="input-group">
                                            <input class="form-control" name="boostRangeDesired" id="boostRangeDesired" type="number" max="{{ $highestAmount }}" placeholder="{{ $highestAmount }}" required>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div id="addons">
                                @if(count($product->productAddons) > 0)
                                    @forelse($product->productAddons as $addon)
                                        <div class="form-group mb-4">
                                            @if($addon->type == "Checkbox")
                                                <div class="custom-control custom-checkbox m-xl-1">
                                                    <input type="checkbox" data-price="{{ $addon->price_in_percent }}" class="custom-control-input optionCheckbox addonElement @if($addon->is_duo_q) duoq @endif" id="addon-{{ $addon->id }}"
                                                           name="addon-checkbox[{{ $addon->id }}]"
                                                           value="{{ $addon->name }}" @if($addon->required_field==1) {{" required "}} @endif >
                                                    <label class="text-light custom-control-label" for="addon-{{ $addon->id }}"> {{ $addon->name }}  @if($addon->price_in_percent > 0) @if($addon->hide_price==0) - Price: <span class="text text-info"> +<span
                                                                    class="percentagePriceLabel">{{ $addon->price_in_percent }}</span>% <span class="d-none">of $<span class="productPriceLabel">{{ $product->price }}</span> ($<span
                                                                    class="productPriceLabelTotal">{{ ($product->price / 100) * $addon->price_in_percent }}</span>)</span> @endif @else
                                                                <span class="text text-success"> FREE @endif </span></label>

                                                </div>
                                            @elseif($addon->type == "Text Input")
                                                <div class="m-xl-1">
                                                    <label class="text-light" for="addon-{{ $addon->id }}">{{ $addon->name }} @if($addon->price_in_percent > 0) @if($addon->hide_price == 0) - Price: <span class="text text-info"> +<span
                                                                    class="percentagePriceLabel">{{ $addon->price_in_percent }}</span>% <span class="d-none"> of $<span class="productPriceLabel">{{ $product->price }}</span> ($<span
                                                                    class="productPriceLabelTotal">{{ ($product->price / 100) * $addon->price_in_percent }}</span>)</span> @endif @else
                                                                <span
                                                                        class="text text-success"> FREE @endif </span></label>
                                                    <input type="text" class="form-control optionTextInput addonElement" data-price="{{ $addon->price_in_percent }}" name="addon-text[{{ $addon->id }}]" id="addon-{{ $addon->id }}" @if($addon->required_field==1) {{" required "}} @endif>
                                                </div>
                                            @elseif($addon->type == "Number Input")
                                                <div class="m-xl-1">
                                                    <label class="text-light" for="addon-{{ $addon->id }}">{{ $addon->name }} @if($addon->price_in_percent > 0) @if($addon->hide_price == 0) - Price: <span class="text text-info"> +<span
                                                                    class="percentagePriceLabel">{{ $addon->price_in_percent }}</span>% <span class="d-none">of $<span
                                                                    class="productPriceLabel">{{ $product->price }}</span> ($<span class="productPriceLabelTotal">{{ ($product->price / 100) * $addon->price_in_percent }}</span>)</span> </span> @endif @else
                                                            <span
                                                                    class="text text-success"> FREE @endif </span></label>
                                                    <input type="number" min="0" step="0.01" class="form-control optionNumberInput addonElement" data-price="{{ $addon->price_in_percent }}" name="addon-number[{{ $addon->id }}]"
                                                           id="addon-{{ $addon->id }}" @if($addon->required_field==1) {{" required "}} @endif>
                                                    <small class="text-light"> Please Note: Any number entered here will affect the price. This is an optional field, please leave it empty if you don't want the addon to apply.</small>
                                                </div>
                                            @elseif($addon->type == "Radio Options")
                                                <label class="text-light" for="addon-{{ $addon->id }}">{{ $addon->name }} @if($addon->price_in_percent > 0) @if($addon->hide_price == 0) - Price: <span class="text text-info"> +<span
                                                                class="percentagePriceLabel">{{ $addon->price_in_percent }}</span>% <span class="d-none">of $<span class="productPriceLabel">{{ $product->price }}</span> ($<span
                                                                class="productPriceLabelTotal">{{ ($product->price / 100) * $addon->price_in_percent }}</span>)</span> @endif @else
                                                            <span
                                                                    class="text text-success"> FREE @endif </span></span></label>
                                                @foreach($addon->option as $option)
                                                    @if($loop->first)
                                                        <div class="custom-control custom-radio m-xl-1">
                                                            <a class="btn btn-sm btn-warning resetButton disabled" data-price="{{ $addon->price_in_percent }}" disabled>Reset Options</a>
                                                        </div>
                                                    @endif
                                                    <div class="custom-control custom-radio m-xl-1">
                                                        <input type="radio" class="custom-control-input optionRadioButton addonElement" data-price="{{ $addon->price_in_percent }}" id="option-{{ $option->id}}" name="radioOptions-{{ $addon->id }}"
                                                               value="{{ $option->value }}" @if($addon->required_field==1) {{" required "}} @endif>
                                                        <label class="text-light custom-control-label" for="option-{{ $option->id}}">{{ $option->value }}</label>
                                                    </div>
                                                @endforeach
                                            @elseif($addon->type == "Drop Down")
                                                <label class="text-light" for="addon-{{ $addon->id }}">{{ $addon->name }}
                                                  <input type="hidden" class="dd_{{$addon->id}}" value="">
                                                  <select name='ddOptions-{{ $addon->id }}' class='form-control dropdownfield' id="{{$addon->id}}" @if($addon->required_field==1) {{" required "}} @endif>
                                                    <option data-amount="" value="">Please Select</option>
                                                @foreach($addon->option as $option)
                                                <option data-amount="{{ $option->amount }}" value="{{$option->id}}">{{$option->value}}  @if($addon->hide_price == 0)
                                                    @if(strstr($option->amount,"-"))
                                                      {{$option->amount}}
                                                    @else
                                                    +{{$option->amount}}
                                                    @endif
                                                   % @endif</option>
                                                @endforeach
                                              </select>
                                            @endif
                                            <small class="text-info">{{ $addon->description }}</small>
                                        </div>
                                    @empty
                                    @endforelse
                            </div>
                            @endif
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="text-light" for="email">@lang('Your Email?'):</label>
                                <input class="form-control" type="text" placeholder="your@email.com" name="email" required>
                            </div>
                            <div class="form-group">
                                <label class="text-light" for="email">@lang('Platform?'):</label>
                                <select class="custom-select" name="platform" id="platform">
                                    <option>PC</option>
                                    @if($product->game->pc_only == 0)
                                        <option>XBOX</option>
                                        <option>Playstation</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-light platform_username" for="platform_username"></label>
                                <input class="form-control" type="text" placeholder="@lang('Please Enter Your Username')" name="platform_username" id="platform_username" required>
                            </div>
                            <div class="form-group">
                                <label class="text-light platform_email" for="platform_email"></label>
                                <input class="form-control" type="text" placeholder="@lang('Please Enter Your Email')" name="platform_email" id="platform_email" required>
                            </div>
                            <div class="form-group">
                                <label class="text-light platform_password" for="platform_password"></label><br>
                                <input class="form-control" id="password" type="password" placeholder="@lang('Please Enter Your Password')" name="platform_password" required>
                                <a class="btn btn-sm btn-warning float-right" id="passwordView"><i class="fas fa-eye" style="color:red;"></i>Show Password</a>
                            </div>
                            <div class="form-group">
                                <label class="text-light" for="promo_code">@lang('Discount Code (if applicable)?'):</label>
                                <br>
                                <small class="text-info">@lang('Please Note: Discounts will be applied at the payment processor checkout')</small>
                                <input class="form-control" type="text" name="promo_code">
                            </div>
                            <div class="form-group">
                                <label class="text-light" for="order_notes">@lang('Order Notes'):</label>
                                <textarea class="form-control" name="order_notes" placeholder="@lang('Order Notes - Authenticator or Specific Information')"></textarea>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="marketing_list" name="marketing_list" value="yes">
                                <label class="text-light form-check-label" for="marketing_list"> @lang('Please add me to your marketing list so I can receive great offers and updates from you').</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="terms_of_service" name="terms_of_service" required>
                                <label class="text-light form-check-label" for="terms_of_service"> @lang('I confirm that all the entered information is accurate and I agree to your terms of use').</label>
                            </div>
                        </div>
                    </div>

                    <hr class="border-secondary">

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="form-group priceDiv mt-4">
                                <label class="text-light" style="font-size: 40px;">@lang('Total Price'): $<span class="price text-info"></span></label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-success">@lang('Order Now')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-12 mt-5">
              <h3 class="white_txt text-center">Reviews</h3>
              <hr>
              <!-- TrustBox script -->
              <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
              <!-- End TrustBox script -->

              <!-- TrustBox widget - Starter -->
              <div class="trustpilot-widget" data-locale="en-US" data-template-id="5613c9cde69ddc09340c6beb" data-businessunit-id="5ecabaf740a1620001fdc75f" data-style-height="100%" data-style-width="100%" data-theme="dark">
              <a href="https://www.trustpilot.com/review/ez-boosting.com" target="_blank" rel="noopener">Trustpilot</a>
              </div>
              <!-- End TrustBox widget -->

            </div>

        </div>
    </div>
    <!---------faq section-------->
<div class="faq_section text-left mt-5">
<div class="container">
<div class="faq-main">
  <div class="faq-inner">
    <h1>Frequently Asked <span>Questions?</span></h1>
  </div><!--faq-inner--end-->
  <div id="accordion">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            What is boosting?
          </button>
        </h5>
      </div>

      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
        Various games have different boosting processes but the idea remains the same. When purchasing a boost, a boosting order is created in our system and a professional player employed by our company gets assigned to complete it. To complete the goal of a specific boost, the professional booster will use their experience and skill advantage to reach a certain rank or level                   </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Can I play with my booster?
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          Yes! Most of our services allow Duo-Q option where you can play with a booster on your own account to your desired rank, We don't need your email or password for this option!
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingThree">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">How can i track my order?
          </button>
        </h5>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
          you can track your order in the Members Area where you will be able to chat with your booster, follow the progress of your boost, and ask your booster about any tips or how long they will need to finish your order!

        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingfour">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
            How much time will it take for my order to get started?
          </button>
        </h5>
      </div>
      <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
        <div class="card-body">
          The approximate waiting time for an order to start highly depends on the game and the time you ordered in. Generally, boosting starts within minutes after paying for an order, unless you want to schedule it to later. It all depends on your preferences.
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingfive">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
            What Payment methods do you accept?
          </button>
        </h5>
      </div>
      <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
        <div class="card-body">
          Currently we only accept Paypal, but we will be adding way more payment methods soon including bitcoin, stripe, paysafecard and more!
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingsix">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
            How do you ensure the safety of my account
          </button>
        </h5>
      </div>
      <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordion">
        <div class="card-body">
          We hire the top rated boosters only, None of our boosters use any kind of cheats, And your details will forever be safe with us! If you still don't feel comfortable you can always pick the Duo-q option!
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingseven">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
            Can my booster stream or play a specific hero?
          </button>
        </h5>
      </div>
      <div id="collapseseven" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
        <div class="card-body">
          Yes! For almost all games we have, We offer streaming, 2X speed. Specific hero feel free to pick any of them or all of them!
        </div>
      </div>
    </div>
  </div>

</div><!--faq-main--end-->
</div><!--container--end-->
</div><!--faq_section--end--->

</section>
<!-- Games end-->


<!-- Footer section -->
@include('frontend.layouts.footer')
@include('frontend.games.products.pricingscript')
</body>
</html>
