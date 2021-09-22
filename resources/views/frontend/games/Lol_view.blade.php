@include('frontend.layouts.header')
<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
@include('frontend.layouts.nav_lol')
<section class=" lol_1BG top_page text-center">
    <div class="row" >
        <div class='col-lg-6 col-md-6 col-sm-12'>
            <div class='lol_headfont'>LEAGUE OF LEGENDS</div>
            <div class='lol_subheadfont'>CLICK ON A SERVICE TO START</div>
        </div>
    </div>
    <div>&ensp;</div>
    <div class = "row col-lg-6 justify-content-center">
         @forelse($products as $product)
             <div class='col-lg-6 col-md-6' style="padding:10px 0px">
                 <button type="button" class="btn btn-lol" ><a href="{{ url('games/'.$game->game_link.'/'.$product->product_link) }}" style="text-transform: uppercase">{{ $product->name }}</a></button></button>&ensp;&ensp;<img  src='{{ asset('frontend/images/games/lol/arrow.png') }}' width='13%'>
             </div>
             @empty
             <p class="text-light">@lang('No products or services found for this game! Please check back soon!')</p>
         @endforelse
    </div>
    <div>&ensp;</div>
    <div>&ensp;</div>
    <div>&ensp;</div>
    <div>&ensp;</div>
</section>
<section>
    <div class=' text-center lol_2BG'>
        <div class=" mt-1.5 lol_2image_font">WHAT OUR CUSTOMERS SAID ABOUT US</div>
        <div class="reviews">
            <div class="mt-1.5 text-center">
                <a href="https://www.trustpilot.com/review/boostingplus.com" target="_blank" rel="noopener"><img src='{{ asset('frontend/images/games/lol/review.png') }}'></a>
             </div>
             <div>
                 <img style='padding:15px' src='{{asset('frontend/images/games/lol/review1.png') }}'>
                 <img style='padding:15px' src='{{asset('frontend/images/games/lol/review2.png') }}'>
                 <img style='padding:15px' src='{{asset('frontend/images/games/lol/review3.png') }}'>
             </div>
        </div>
    </div>
</section>
<section class ='lol_3BG'  >
    <div class='row justify-content-center' >
        <div class=" mt-4 col-12 cmw_main_font">ODERING & TRACKING MADE EASY</div>
        <div class='row mt-5  justify-content-center'>
            <div class="cont col-lg-4 col-md-4 text-center">
                <div class="my-3 cmw_order_font">1) FILL IN THE ORDER FORM & PAGE</div>
                <img class="mb-5  image" style='border-radius: 5%' src='{{asset('frontend/images/games/lol/order.png') }}'>
                <div class="overlay_lol">
                    <a href="#" class="icon" title="User Profile">
                      <i class="fa fa-cart-plus"></i>
                    </a>
                </div>
            </div>
            <div  class="col-lg-4 col-md-4 text-center">
                <img class="mt-3 " src='{{asset('frontend/images/games/lol/logo.png')}}' width='70%'>
            </div>
            <div class="cont col-lg-4 col-md-4 text-center">
                <div class="my-3 cmw_order_font">2) LIVE TRACK YOUR ORDER PAGE</div>
                <img class="mb-5 image" style='border-radius: 5%' src='{{asset('frontend/images/games/lol/chat.png') }}'>
                <div class="overlay_lol">
                    <a href="#" class="icon" title="User Profile">
                      <i class="fa fa-user"></i>
                    </a>
            </div>
        </div>
    </div>
</section>
<section class="lol_4BG text-center" style='padding:0px 10%'>
        <div>&ensp;</div>
        <div class=" lol_blog_main_font">BLOG & GUIDE</div>
        <div class=' row mt-5  justify-content-center'>
            <div class='mt-3 col-lg-4 col-md-4 text-center'>
                <img src='{{asset('frontend/images/games/lol/blog1.png') }}' width='70%'>
            </div>
            <div class='mt-3 col-lg-4 col-md-4 text-center'>
                <img  src='{{asset('frontend/images/games/lol/blog2.png') }}' width='70%'>
            </div>
            <div class='my-3 col-lg-4 col-md-4 text-center'>
                <img  src='{{asset('frontend/images/games/lol/blog3.png') }}' width='70%'>
            </div>
        </div>
        <button type="button" class="btn btn-prima" ><a href="#">EXPLORE THE BLOG</a></button>
   <div>&ensp;</div>
   <div>&ensp;</div>
</section>
<section class='lol_5BG text-center'>
    <div>&ensp;</div>
    <div class="faq_section">
        <div class="container-fluid container-fluid_add">
        <div class="faq-main">
          <div class="faq-inner">
            <h1>League of Legends Boosting FAQ</h1>
          </div><!--faq-inner--end-->
          <div id="accordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed " data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    What is League of Legends boosting?
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    League of Legends boosting is a variety of services directed at improving your League of Legends account in a fast, safe and anonymous way. For instance, division boosting service aims to increase your division. Valorant placement matches boosting goal is to win as many placement games possible with win-rate guarantees included. There are many services available at your disposal, handled by professional Valorant players.
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How does League of Legends boosting work?
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    First step is to customize your desired boost on the service page that you’re interested in. After an order has been made, you gain access to your personal order page where you can track your order, or schedule playing times with your booster until the desired goal is reached, depending whether you chose a solo (account sharing) or duo (self-play) service.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    How much does League of Legends boost cost?
                  </button>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    Each service has different pricing, and each service is fully customizable to your need, therefore, the price varies for every specific order. The boosting starts from as low as 5$ for lower ranks and levels. You can find out all the prices on the service’s page.

                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingfour">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                    Can I play with your boosters instead of giving out my account?
                  </button>
                </h5>
              </div>
              <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                <div class="card-body">
                    Yes. Most of our services allow self-playing feature where you can play with our booster on your own account to your desired goal.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingfive">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                    Can I watch the booster play when doing an account sharing boost?
                  </button>
                </h5>
              </div>
              <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                <div class="card-body">
                    Yes. The live streaming feature is available for an extra 15% on top of your order.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingsix">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                    What additional features do you offer to customize a boosting order?
                  </button>
                </h5>
              </div>
              <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordion">
                <div class="card-body">
                    We offer live streaming of your order, express orders that are completed faster than regular orders, paying half now half later for larger orders and playing specific heroes that you tell us to on your account.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingseven">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
                    Can I choose which champions a booster will play?
                  </button>
                </h5>
              </div>
              <div id="collapseseven" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                <div class="card-body">
                    Yes. In the step 4 on the service page, select the SPECIFIC LEGENDS feature in order to list your heroes so our booster can play only those heroes on your boost.
                </div>
              </div>
            </div>
          </div>

        </div><!--faq-main--end-->
        </div><!--container--end-->
        </div><!--faq_section--end--->
        <button type="button" class=" btn btn-prima" ><a href="#">LOAD MORE</a></button>
        <div>&ensp;</div>
        <div>&ensp;</div>
</section >

@include('frontend.layouts.footer')
</body>
</html>
