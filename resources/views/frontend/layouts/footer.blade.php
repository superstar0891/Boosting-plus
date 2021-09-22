<div class="footer_section">
	<div class='container-fluid'>
	    <div class="row">
	            <div class='col-lg-4 col-md-4'>
	    	        <h4>ALL GAMES</h4>
					@foreach ($games as $game)
					    <div class='col-lg-12'>
	    	             <a href="{{ url('games/' .$game->game_link) }}"><h6>{{ $game->game_name }}</h6></a>
	    	            </div>
					@endforeach
				</div>
    
	            <div class='col-lg-4 col-md-4'>
	    	        <div style='display: inline-block;'><a class="nav-link " href="#"><h5>TEAMS OF USE</h5></a></div>
	    	        <div style='display: inline-block;'><a class="nav-link " href="#"><h5>PRIVACY POLICY</h5></a></div>
	    	        <div style='display: inline-block;'><a class="nav-link " href="#"><h5>REFUND POLICY</h5></a></div>
	    	     </div>
	            <div class='col-lg-4 col-md-4'>
	    		   <img  src="{{ asset('frontend/images/') }}/card.png" width=30%><br>&ensp;<br>
	    		   <a href='#'><img  src="{{ asset('frontend/images/') }}/review.png" width=30%></a>
	    		</div>
	    </div>
		<hr>
		<div class="row">
	        <div class='col-lg-12 col-md-12'>
	            <h6 style='color: white; margin: 0% 10%;'>Boosting Plus isn't endorsed of in any way affiliated with Activision Blizzard, Riot Games, Electronic Arts of Respawn Entertainment and doesn't reflect the views
	            of opinions of anyone officially involved in producing or managing Hearthstone, Destiny 2, Apex Legends, Overwatch, Call of Duty, Valorant and League of legends.<br>
	            All trademarks and logos belong to their respecitive owners.
	            All submitted art content remains copyright of its original copyright holder. </h6>
	            <hr>
	            <div class="social_section">
	            	<ul>
	            	
	            	<li><a href="https://www.facebook.com/"><i class="fab fa-3x fa-facebook"></i></a></li>
	            	<li><a href="https://twitter.com/"><i class="fab fa-3x fa-twitter"></i></a></li>
	            	<li><a href="https://www.instagram.com/"><i class="fab fa-3x fa-instagram"></i></a></li>
	            	<li><a href="https://discordapp.com/users/703274331643576381"><i class="fab fa-3x fa-discord"></i></a></li>
	            	
	            	</ul>
	            </div>
	        </div>
        </div>
	    	<hr>
		<h5 style='text-align: center;'> ©2021 BoostingPlus.&ensp;All rights reserved.</h5>
    </div>
</div>



<!--====== Javascripts & Jquery ======-->

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
</script>

<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.slicknav.min.js') }}"></script>
<script src="{{ asset('frontend/js/sticky-sidebar.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/rangeslider.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.owl-carousel').owlCarousel({
			loop: true,
			margin: 10,
			responsiveClass: true,
			responsive: {
				0: {
					items: 1,
					nav: true
				},
				600: {
					items: 3,
					nav: false
				},
				1000: {
					items: 5,
					nav: true,
					loop: false,
					margin: 20
				}
			}
		})
	})
</script>

