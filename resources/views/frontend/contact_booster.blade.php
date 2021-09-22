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
						<select class='form-control' onchange="window.location.href='/contact-promotor'">
							<option>Promotor Form</option>
							<option selected>Booster Form</option>
						</select>
					</div>
			</div>
			<div class="row mt-3">
					<div class="col-md-12">
						<h2>Booster Description:</h2>
					</div>
					<div class="col-md-12 mt-2">
						<p>Do you want to start boosting for EZ-Boosting?
							<br>
						Select a game and contact us now!</p>
					</div>
			</div>
		</div>

		<form name="form124" method="post">
			<div class="container">
				<div class="row">
						<div class="col-md-12">
								<h3 class="white_txt">Contact Form:</h3>
						</div>
				</div>
				<div class="row mt-2">
					<div class="col-md-6 mx-auto">
						<div class="form-group ">
							<div class="row">
									<div class="col-md-12">
										<select name="game_name" class="form-control" required>
											<option value="">Select Game</option>
											<option>Overwatch</option>
											<option>League of Legends</option>
											<option>Fortnite</option>
											<option>Apex legends</option>
											<option>Rainbow six siege</option>
											<option>Fall guys</option>
											<option>Smite</option>
											<option>Rocket league</option>
											<option>Valorant</option>
											<option>Dota 2</option>
										</select>
									</div>
							</div>
						</div>
						<div class="form-group ">
							<div class="row">
									<div class="col-md-12"><input type="email" class="form-control" required name="email" placeholder="Enter Email"></div>
							</div>
						</div>
						<div class="form-group ">
							<div class="row">
									<div class="col-md-12"><input type="text" class="form-control" required name="discord" placeholder="Enter Discord"></div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
									<div class="col-md-12">
										<textarea name="handle_service" class="form-control" placeholder="What kind of service can you handle?"></textarea>
									</div>
							</div>
						</div>
						<div class="form-group ">
							<div class="row">
									<div class="col-md-12"><input type="text" class="form-control" required name="time_dedicate" placeholder="How much time can you dedicate?"></div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
									<div class="col-md-12">
										<textarea name="prev_exp" class="form-control" placeholder="Tell us about yourself!"></textarea>
									</div>
							</div>
						</div>
						<div class="form-group ">
							<div class="row">
									<div class="col-md-12"><textarea class="form-control" name="highest_rank" placeholder="tell us about yourself and your highest rank!"></textarea></div>
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
