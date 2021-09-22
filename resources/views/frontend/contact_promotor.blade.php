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
						<h2>Category:</h2>
					</div>
					<div class="col-md-3 mt-4 mx-auto">
						<select class='form-control' onchange="window.location.href='/contact-booster'">
							<option selected>Promotor Form</option>
							<option>Booster Form</option>
						</select>
					</div>
			</div>
			<div class="row mt-3">
					<div class="col-md-12">
						<h2>Promotor Description:</h2>
					</div>
					<div class="col-md-12 mt-2">
					<p>
						Do you wanna earn some extra money?
							<br>
						Do you think you can bring clients to our website?
							<br>
						Contact us now and let's start our partnership!
					</p>
					</div>
			</div>
		</div>

		<form name="form124" method="post">
			{{csrf_field()}}
			<div class="container">
				<div class="row">
						<div class="col-md-12">
								<h3 class="white_txt">Contact Form:</h3>
						</div>
				</div>
				<div class="row mt-2">
					<div class="col-md-6 mx-auto">
						<div class="form-group">
							<div class="row">
									<div class="col-md-12"><input type="email" class="form-control" required name="email" placeholder="Enter Email"></div>
							</div>
						</div>
						<div class="form-group ">
							<div class="row">
									<div class="col-md-12">
										<select name="stream" class="form-control" required>
											<option value="">Streamer</option>
											<option>Youtube</option>
											<option>Instagram page</option>
											<option>Twitter</option>											
											<option>Other</option>
										</select>
									</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
									<div class="col-md-12">
										<input type="text" name="viewer" class="form-control" placeholder="Average Viewer or potential  clients">
									</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
									<div class="col-md-12">
										<textarea name="ideas" class="form-control" placeholder="Tell us how you are planning on advertising for EZ-Boosting!"></textarea>
									</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
									<div class="col-md-12">
										<input type="submit" name="submit" class="btn btn-primary" value="Send">
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>


	</div>






	<!-- Footer section -->
@include('frontend.layouts.footer')
	</body>
</html>
