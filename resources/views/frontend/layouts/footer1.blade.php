<div class="footer_section">
	<div class="container">
		<ul class="navbar-nav-2">
			<li class="nav-item active">
				<a class="nav-link" href="#">HOME</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Games
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown2">
					<a class="dropdown-item" href="{{ url('games/overwatch') }}">Overwatch</a>
                <a class="dropdown-item" href="{{ url('games/Apex-Legends') }}">Apex Legends</a>
                <a class="dropdown-item" href="{{ url('games/Fall-Guys') }}">Fall Guys</a>
                <a class="dropdown-item" href="{{ url('games/Smite') }}">Smite</a>
                <a class="dropdown-item" href="{{ url('games/Valorant') }}">Valorant</a>
                <a class="dropdown-item" href="{{ url('games/League-of-legends') }}">League of legends</a>
                <a class="dropdown-item" href="{{ url('games/Fortnite') }}">Fortnite</a>
                <a class="dropdown-item" href="{{ route('games') }}">All Games</a>
				</div>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="/loyalty">LOYALTY</a>
			</li>
			<li class="nav-item">
				<a class="nav-link " href="#">CONTACT US</a>
			</li>
		</ul>
		<p class="footer-p text-center">This website is not endorsed or in any way affiliated with Activision Inc, Electronic Arts Inc, Valve Corporation, Riot Games Inc, Respawn Entertainment,Hi-Rez Studios, Mediatonic, Psyonix Studios or Epic Games and does not reflect the views or opinions of the aforementioned entities or anyone officially involved in producing or managing Overwatch, Fortnite, Call of Duty Franchise, League of Legends, Valorant,  Rainbow Six Siege, Rocket League, Teamfight Tactics, Hyper Scape , Rogue Company, Smite, Fall guys , Dota 2 or Apex Legends. are trademarks or registered trademarks of the aforementioned entities in the U.S. and/or other countries. All submitted art content remains copyright of its original copyright holder.</p>
		<hr>
		<div class="social_section">
			<ul>
        <li><a href="https://wa.me/9660502576224?text=I'm interested in the EZ-Boosting services"><i class="fab fa-whatsapp"></i></a></li>
        <li><a href="https://www.facebook.com/ez.boosting.52"><i class="fab fa-facebook"></i></a></li>
        <li><a href="https://twitter.com/Ez_Boostingg"><i class="fab fa-twitter"></i></a></li>
        <li><a href="https://www.instagram.com/Ez_Boostingg/"><i class="fab fa-instagram"></i></a></li>
        <li><a href="https://discordapp.com/users/703274331643576381"><i class="fab fa-discord"></i></a></li>
        <li><a href="skype:live:.cid.6845665e61d18c55?chat"><i class="fab fa-skype"></i></a></li>
			</ul>
			<p style="color: #1d2f34;font-size: 14px ">© 2020 EZ-Boosting. All Rights Reserved.</p>
			<div class="footer_logo">
				<img src="/frontend/banners/logo.png">
			</div>
		</div><!--social_section--end-->
	</div><!--container-->
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
<script src="{{ mix('frontend/js/main.js') }}"></script>
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

