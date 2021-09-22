@include('frontend.layouts.header')
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	@include('frontend.layouts.nav')
	<!-- Hero section -->
	<div id="demo" class="carousel slide" data-ride="carousel">

		<!-- Indicators -->
		<ul class="carousel-indicators">
			<!-- <li data-target="#demo" data-slide-to="0" class="active"></li>
			<li data-target="#demo" data-slide-to="1"></li>
			<li data-target="#demo" data-slide-to="2"></li>
			<li data-target="#demo" data-slide-to="3"></li>
			<li data-target="#demo" data-slide-to="4"></li>
			<li data-target="#demo" data-slide-to="5"></li> -->
		</ul>

		<!-- The slideshow -->
		<div class="carousel-inner">
			<div class="carousel-item active">
				<div class="container">
					<div class="banner_inner">
						<!-- <h2>  </h2> -->
							<h1>GET TO YOUR <span>DREAM</span><br> RANK NOW!</h1>
								<p>EZ-Boosting provides professional boosting, With the cheapest prices for over 10 games!! Select your game and get to any rank you ever wanted NOW!</p>
								<a class="banner_button" href="/games">Order Now</a>
							</div><!--banner_inner--end-->
						</div><!--container--end-->
					</div>
						
								</div>

								<!-- Left and right controls -->
								<!-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
									<span class="carousel-control-prev-icon"></span>
								</a>
								<a class="carousel-control-next" href="#demo" data-slide="next">
									<span class="carousel-control-next-icon"></span>
								</a> -->
							</div>

							<!------------carowsel-------->
	<!-- Hero section end-->

	<!------game logo section---------------------->
	<div class="game_logo">
		<div class="container">
			<section id="demos">
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel owl-theme">
							<div class="item">
								<a href="https://ez-boosting.com/games/Overwatch"><img src="{{asset('frontend/crousal/overwatch.png')}}"></a>
							</div>
							<div class="item">
								<a href="https://ez-boosting.com/games/Apex-Legends"><img src="{{asset('frontend/crousal/apex.jpg')}}"></a>
							</div>
							<div class="item">
								<a href="https://ez-boosting.com/games/Fall-Guys"><img src="{{asset('frontend/crousal/fall_guys.png')}}"></a>
							</div>
							<div class="item">
								<a href="https://ez-boosting.com/games/Fortnite"><img src="{{asset('frontend/crousal/fortnite.png')}}"></a>
							</div>
							<div class="item">
								<a href="https://ez-boosting.com/games/Valorant"><img src="{{asset('frontend/crousal/valorant.png')}}"></a>
							</div>
							<div class="item">
								<a href="https://ez-boosting.com/games/Smite"><img src="{{asset('frontend/crousal/smite.png')}}"></a>
							</div>
							<div class="item">
								<a href="https://ez-boosting.com/games/League-of-legends"><img src="{{asset('frontend/crousal/lol.png')}}"></a>
							</div>
							<div class="item">
								<a href="https://ez-boosting.com/games/Rainbow-Six-Siege"><img src="{{asset('frontend/crousal/rss.png')}}"></a>
							</div>
							<div class="item">
								<a href="#"><img src="{{asset('frontend/crousal/csgo.png')}}"></a>
							</div>
							<div class="item">
								<a href="#"><img src="{{asset('frontend/crousal/pubg.png')}}"></a>
							</div>										
							<div class="item">
								<a href="#"><img src="{{asset('frontend/crousal/rocket_league.png')}}"></a>
							</div>			
							<div class="item">
								<a href="#"><img src="{{asset('frontend/crousal/dota.png')}}"></a>
							</div>
							
							
						</div>



					</div>
				</div>
			</section>
			<!--game_logo-inner--end-->
			<div class="gaming_feature_section">
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-3 my-c">
						<div class="gaming_feature_inner img_one">
							<img src="{{asset('/frontend/how_it_works/oder_track.png')}}">
							<h3>Order Tracking & Scheduling</h3>
							<p>Our platform provides order tracking and scheduling for all users. When you submit a boosting order, it creates a private section for you in the member's area. In your order, you can follow up on the progress made by the booster and also schedule boosting hours in the chat.</p>
						</div><!--gaming_feature_inner--end-->
					</div><!--col-end-->
					<div class="col-sm-12 col-md-6 col-lg-3 my-c">
						<div class="gaming_feature_inner img_two">
							<img src="{{asset('/frontend/how_it_works/doller.png')}}">
							<h3>Cost-Efficient and Flexible solution</h3>
							<p>Regardless of your game choice, Ez-boosting aims to bring you the lowest prices attainable. Other than providing a cost-efficient boost service for the most popular online games, we remain flexible to give you additional discounts and custom orders in live chat or from speaking with the admins in Discord or Skype!</p>
						</div><!--gaming_feature_inner--end-->
					</div><!--col-end-->
					<div class="col-sm-12 col-md-6 col-lg-3 my-c">
						<div class="gaming_feature_inner img_three">
							<img src="{{asset('/frontend/how_it_works/safety.png')}}">
							<h3>Safety & Privacy</h3>
							<p>We only work with the highest-rated and most credible boosters from the industry that we pre tested and worked with for many months if not years at least!</p>
						</div><!--gaming_feature_inner--end-->
					</div><!--col-end-->
					<div class="col-sm-12 col-md-6 col-lg-3 my-c">
						<div class="gaming_feature_inner img_four">
							<img src="{{asset('/frontend/how_it_works/live-chat.png')}}">
							<h3>Live Chat</h3>
							<p>We offer 24/7 live chat just incase you needed help with anything! And we always have a new discount code there so make sure to use it!</p>
						</div><!--gaming_feature_inner--end-->
					</div><!--col-end-->
				</div><!--row end-->
			</div><!--gaming_feature_section--end-->
		</div><!--container--end-->
	</div><!--game_logo--end-->


	<!---------------------------middle section--------->
	<div class="middle_section text-center">
		<div class="container">
<!-- <div class="review_section">
<h5>REVIEWS</h5>
<h2>WE TAKE PRIDE IN OUR USER SATISFACTION</h2>
</div>review-section--end -->
<div class="reviews">
	<div class="mt-5">
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
<div class="how_it_work">
<h2>How It Works</h2>
<div class="htw">
	<ul>
		<li><img src="{{asset('frontend/banners/h1.png')}}">
			<p>Choose a game and select a service</p>
		</li>
		<li><img src="{{asset('frontend/banners/h2.png')}}"><p>Use one of our money payment methods</p></li>
		<li><img src="{{asset('frontend/banners/h3.png')}}"><p>Fill in your details in the order form</p></li>
		<li><img src="{{asset('frontend/banners/h4.png')}}"><p>A professional booster starts the boosting process</p></li>
		<li><img src="{{asset('frontend/banners/h5.png')}}"><p>Enjoy your new new rank!
		</p></li>
	</ul>
</div><!--game_logo-inner--end-->
</div><!--how_it_work-->
</div><!--container--end-->
<!---------faq section-------->
<div class="faq_section text-left">
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
				Various games have different boosting processes but the idea remains the same. When purchasing a boost, a boosting order is created in our system and a professional player employed by our company gets assigned to complete it. To complete the goal of a specific boost, the professional booster will use their experience and skill advantage to reach a certain rank or level										</div>
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

</div><!--middle_section--end-->

	<!-- Footer section -->
@include('frontend.layouts.footer')
	</body>
</html>
