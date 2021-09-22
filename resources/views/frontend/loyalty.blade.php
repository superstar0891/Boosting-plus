@include('frontend.layouts.header')
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	@include('frontend.layouts.nav')
	<div class="loyalty_header text-center">
		<div class="container">
			<div class="row">
					<div class="col-md-12">
						<h2>Loyalty Program</h2>
					</div>
					<div class="col-md-12 mt-4">
						<p>EZ-Boosting provides the best loyalty system in the market offering discounts up to 15%!</p>
						<p>Feel special with us and get a custom discount code that no one else can use! Start getting boosted for cheaper now!</p>
					</div>
			</div>
		</div>

		<div class="container mt-5">
				<div class="row">
					<div class="col-md-3">
						<div class="box">
							Bronzer<br><strong>5% off</strong>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box">
							Silver<br><strong>8% off</strong>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box">
							Gold<br><strong>12% off</strong>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box">
							Diamond<br><strong>15% off</strong>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-12">
						<div class="progress">
	  					<div class="progress-bar" role="progressbar" style="width: 63%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-3">
						<div class="box box_white">
							50$ spent<br> or <strong>a review on Trustpilot</strong>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box box_white">
							150$ spent<br> or <strong>15 orders</strong>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box box_white">
							250$ spent<br> or <strong>20 orders</strong>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box box_white">
							500$ spent<br> or <strong>30 orders</strong>
						</div>
					</div>
				</div>
		</div>
		<div class="container mt-5">
			<div class="row">
					<div class="col-md-4">
						<div class="finance">
							<i class="fa fa-heart"></i>
							<h3 class="mt-3">Our way to say thank you</h3>
							<p class="mt-3">This is our way to say thank you for our returning clients. Thank you for trusting us and coming back everytime you need help!</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="finance">
							<i class="fa fa-money-bill"></i>
							<h3 class="mt-3">Best prices</h3>
							<p class="mt-3">Beside us having the cheapest prices in the market, EZ-Boosting provides the best discounts!</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="finance">
							<i class="fa fa-info"></i>
							<h3 class="mt-3">Priority</h3>
							<p class="mt-3">Our loyal clients are our top priority, so whenever you use your special discount code you will have higher priority level than other orders.</p>
						</div>
					</div>
			</div>
			<div class="row text-left mt-5 pb-5">
				<div class="col-md-12">
					<p><small style="display:none;">*Only purchases of 10$ or more are elegible for the order count, to avoid exploiting</small></p>
				</div>
			</div>
		</div>

	</div>






	<!-- Footer section -->
@include('frontend.layouts.footer')
	</body>
</html>
